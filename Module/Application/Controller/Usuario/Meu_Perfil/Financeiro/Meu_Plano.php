<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Meu_Plano as View_Meu_Plano;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Model\DAO\Fatura as DAO_Fatura;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\OBJ\Entidade as OBJ_Entidade;
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    use Module\Application\Model\DAO\Removido as DAO_Removido;
    use Module\Application\Model\OBJ\Removido as OBJ_Removido;
    use Module\Application\Controller\Common\Util\GerenciarFaturas;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Conexao;
    use \Exception;
    
    class Meu_Plano
    {
        function __construct()
        {
            
        }
        
        /**
         * Plano escolhido pelo usuario.
         * 
         * @var int $plano_id
         */
        private $plano_id;
        
        /**
         * Senha do usuario informada para Cancelar a Contratação.
         * 
         * @var string $senha_usuario
         */
        private $senha_usuario;
        
        /**
         * Lista com todas as mensagens de erro.
         * 
         * @var array $erros 
         */
        private $erros = [];
        
        /**
         * Lista com tudas as mensagens de sucesso.
         * 
         * @var array $sucessos
         */
        private $sucessos = [];
        
        /**
         * @param int $plano_id
         */
        public function set_plano_id($plano_id) : void
        {
            try {
                $this->plano_id = Validador::Plano()::validar_id($plano_id);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->plano_id = Validador::Plano()::filtrar_id($plano_id);
            }
        }
        
        /**
         * Seta Senha do usuario informada para Cancelar a Contratação.
         * 
         * @param string $senha_usuario
         */
        public function set_senha_usuario($senha_usuario) : void
        {
            try {
                $this->senha_usuario = Validador::Usuario()::validar_senha_login($senha_usuario);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Instancia e abre a View
         * 
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                if ($status != 0) {
                    $view = new View_Meu_Plano($status);
                    
                    $planos = DAO_Plano::BuscarTodos();
                    
                    if (!empty($planos) AND $planos != false) {
                        $view->set_planos($planos);
                    }
                    
                    $view->set_plano_id(Login_Session::get_entidade_plano());
                    
                    $view->Executar();
                }
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Salvar novo plano escolhido pelo usuario
         * 
         * @return number|NULL|boolean
         */
        public function Salvar_Novo_Plano()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                if ($status != 0) {
                    if (empty($this->erros)) {
                        Conexao::$conection->beginTransaction();
                        
                        if (GerenciarFaturas::Criar_Fatura(Login_Session::get_entidade_id(), $this->plano_id, GerenciarFaturas::IMEDIATA)) {
                            $obj_entidade = new OBJ_Entidade();
                            $obj_entidade->set_id(Login_Session::get_entidade_id());
                            $obj_entidade->set_plano_id($this->plano_id);
                            $obj_entidade->set_intervalo_pagamento_id(1);
                            $obj_entidade->set_data_contratacao_plano(date('Y-m-d H:i:s'));
                            
                            if (DAO_Entidade::Atualizar_Financeiro($obj_entidade)) {
                                if (Conexao::$conection->commit()) {
                                    Login_Session::set_entidade_plano($this->plano_id);
                                } else {
                                    Conexao::$conection->rollBack();
                                    $this->erros[] = 'Erro Fatal ao tentar salvar modificações';
                                }
                            } else {
                                if (Conexao::$conection->rollBack()) {
                                    $this->erros[] = 'Erro ao tentar Ativar novo plano';
                                } else {
                                    $this->erros[] = 'Erro Fatal ao tentar salvar modificações';
                                }
                            }
                        } else {
                            if (Conexao::$conection->rollBack()) {
                                $this->erros[] = 'Erro ao tentar gerar nova fatura';
                            } else {
                                $this->erros[] = 'Erro Fatal ao tentar salvar modificações';
                            }
                        }
                    }
                    
                    $retorno['erros'] = [];
                    $retorno['status'] = 'certo';
                    
                    if (!empty($this->erros)) {
                        $retorno['erros'] = $this->erros;
                        $retorno['status'] = 'erro';
                    }
                    
                    echo json_encode($retorno);
                }
            }
        }
        
        /**
         * Deleta todas as peças do usuario logado.
         * Ativa o plano padrão (Gratuito).
         * Cancela as faturas, aberta e fechada.
         *
         * @return number|NULL|boolean
         */
        public function Cancelar_Contratacao()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                if ($status != 0) {
                    $faturas_pendentes = DAO_Fatura::BuscarPorCodStatus(Login_session::get_entidade_id(), 2, 16, 32, 128);
                    
                    if (count($faturas_pendentes) === 0) {
                        if (empty($this->erros)) {
                            if (Login_Session::get_entidade_plano() > 1) {
                                if (password_verify($this->senha_usuario, DAO_Usuario::Buscar_Senha_Usuario(Login_Session::get_usuario_id()))) {
                                    
                                    $num_pecas = DAO_Peca::Buscar_Quantidade_Pecas_Por_Entidade(Login_Session::get_entidade_id());
                                    
                                    if (DAO_Peca::DeletarPorEntidade(Login_Session::get_entidade_id())) {
                                        $this->sucessos[] = 'Peças Deletadas com sucesso';
                                        
                                        $entidade = new OBJ_Entidade();
                                        $entidade->set_id(Login_Session::get_entidade_id());
                                        
                                        $usuario_responsavel = new OBJ_Usuario();
                                        $usuario_responsavel->set_id(Login_Session::get_usuario_id());
                                        
                                        $obj_removido = new OBJ_Removido();
                                        $obj_removido->set_obj_entidade($entidade);
                                        $obj_removido->set_obj_usuario($usuario_responsavel);
                                        $obj_removido->set_datahora(date('Y-m-d H:i:s'));
                                        
                                        for ($i=0; $i < $num_pecas; $i++) {
                                            DAO_Removido::Inserir($obj_removido);
                                        }
                                        
                                        if (GerenciarFaturas::Criar_Fatura(Login_Session::get_entidade_id(), 1, GerenciarFaturas::IMEDIATA)) {
                                            $obj_entidade = new OBJ_Entidade();
                                            $obj_entidade->set_id(Login_Session::get_entidade_id());
                                            $obj_entidade->set_plano_id(1);
                                            $obj_entidade->set_intervalo_pagamento_id(1);
                                            $obj_entidade->set_data_contratacao_plano(date('Y-m-d H:i:s'));
                                            if (DAO_Entidade::Atualizar_Financeiro($obj_entidade)) {
                                                Login_Session::set_entidade_plano(1);
                                            } else {
                                                $this->erros[] = 'Erro Fatal ao tentar salvar modificações da Entidade';
                                            }
                                        }
                                    } else {
                                        $this->erros[] = 'Erro ao tentar deletar as peças';
                                    }
                                } else {
                                    $this->erros[] = 'Erro: Senha Incorreta';
                                }
                            } else {
                                $this->erros[] = 'O plano mínimo gratuito já está ativado';
                            }
                        }
                    } else {
                        $this->erros[] = 'O plano não pode ser alterado até ser confirmado o pagamento da fatura pendente no sistema';
                    }
                    
                    $retorno['erros'] = [];
                    $retorno['sucessos'] = [];
                    $retorno['status'] = 'certo';
                    
                    if (!empty($this->erros)) {
                        $retorno['erros'] = $this->erros;
                        $retorno['status'] = 'erro';
                    }
                    
                    echo json_encode($retorno);
                }
            }
        }
    }
