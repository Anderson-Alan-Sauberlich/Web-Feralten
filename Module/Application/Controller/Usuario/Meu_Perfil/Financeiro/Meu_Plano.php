<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Meu_Plano as View_Meu_Plano;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Faturas as Controller_Faturas;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\Object\Entidade as Object_Entidade;
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
         * @var int $plano_id Plano escolhido pelo usuario
         */
        private $plano_id;
        
        /**
         * @var array $erros Array com todas as mensagens de erro
         */
        private $erros;
        
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
         * Instancia e abre a View
         * 
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                if ($status != 0) {
                    $view = new View_Meu_Plano($status, DAO_Plano::BuscarTodos(), Login_Session::get_entidade_plano());
                    
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
                    $retorno = array();
                    $retorno['status'] = 'certo';
                    $retorno['erros'] = array();
                    
                    if (empty($this->erros)) {
                        Conexao::$conection->beginTransaction();
                        
                        if (Controller_Faturas::Criar_Fatura(Login_Session::get_entidade_id(), $this->plano_id, Controller_Faturas::IMEDIATA)) {
                            $object_entidade = new Object_Entidade();
                            $object_entidade->set_id(Login_Session::get_entidade_id());
                            $object_entidade->set_plano_id($this->plano_id);
                            $object_entidade->set_intervalo_pagamento_id(1);
                            $object_entidade->set_data_contratacao_plano(date('Y-m-d H:i:s'));
                            
                            if (DAO_Entidade::Atualizar_Financeiro($object_entidade)) {
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
                    
                    if (!empty($this->erros)) {
                        $retorno['erros'] = $this->erros;
                        $retorno['status'] = 'erro';
                    }
                    
                    echo json_encode($retorno);
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
