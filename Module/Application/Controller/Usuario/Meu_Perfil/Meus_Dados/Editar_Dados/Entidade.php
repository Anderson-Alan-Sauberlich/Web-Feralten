<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade as View_Entidade;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\Object\Entidade as Object_Entidade;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Gerenciar_Imagens;
    use Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Faturas as Controller_Faturas;
    use \Exception;
    
    class Entidade
    {
        function __construct()
        {
            
        }
        
        /**
         * @var string $cpf_cnpj Numero do CPF ou CPNJ da Entidade
         */
        private $cpf_cnpj;
        
        /**
         * @var string $site Endereço do Site da Entidade
         */
        private $site;
        
        /**
         * @var string $nome_comercial Nome Comercial da Entidade
         */
        private $nome_comercial;
        
        /**
         * @var array $erros Array com todos os erros
         */
        private $erros = [];
        
        /**
         * @var array $sucesso Array com todos as Mensagens de Sucesso
         */
        private $sucessos = [];
        
        /**
         * @var array $campos Array com todos os Status dos Campos do Formulario
         */
        private $campos = [];
        
        /**
         * @param string $cpf_cnpj
         */
        public function set_cpf_cnpj($cpf_cnpj) : void
        {
            try {
                $this->cpf_cnpj = Validador::Entidade()::validar_cpf_cnpj($cpf_cnpj);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['cpf_cnpj'] = 'erro';
                
                $this->cpf_cnpj = Validador::Entidade()::filtrar_cpf_cnpj($cpf_cnpj);
            }
        }
        
        /**
         * @param string $site
         */
        public function set_site($site = null) : void
        {
            try {
                $this->site = Validador::Entidade()::validar_site($site);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['site'] = 'erro';
                
                $this->site = Validador::Entidade()::filtrar_site($site);
            }
        }
        
        /**
         * @param string $nome_comercial
         */
        public function set_nome_comercial($nome_comercial = null) : void
        {
            try {
                $this->nome_comercial = Validador::Entidade()::validar_nome_comercial($nome_comercial);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['nome_comercial'] = 'erro';
                
                $this->nome_comercial = Validador::Entidade()::filtrar_nome_comercial($nome_comercial);
            }
        }
        
        /**
         * Retorna todass as Mensagens de Erro em lista.
         *
         * @return array
         */
        public function get_erros() : array
        {
            return $this->erros;
        }
        
        /**
         * Retorna todas as Mensagens de Sucesso em lista.
         *
         * @return array
         */
        public function get_sucessos() : array
        {
            return $this->sucessos;
        }
        
        /**
         * Retorna todos os campos do formulario com estatus de erro.
         *
         * @return array
         */
        public function get_campos() : array
        {
            return $this->campos;
        }
        
        /**
         * Instancia e Abre a View
         *
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status != 0) {
                    $view = $this->Retornar_Pagina();
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Instancia e Retorna a View
         *
         * @return View_Entidade
         */
        public function Retornar_Pagina() : View_Entidade
        {
            $view = new View_Entidade();
            
            if (Login_Session::Verificar_Entidade()) {
                $obj_entidade = DAO_Entidade::BuscarPorCOD(Login_Session::get_entidade_id());
                
                if ($obj_entidade instanceof Object_Entidade) {
                    $view->set_obj_entidade($obj_entidade);
                    
                    if (empty($obj_entidade->get_imagem())) {
                        $obj_entidade->set_imagem(self::Pegar_Imagem_URL($obj_entidade->get_imagem()));
                    }
                }
            }
            
            return $view;
        }
        
        /**
         * Function chamada por ajax para salvar os valores do form.
         * Retorna um Json com as mensagens de erro, sucesso e os campos respectivos.
         */
        public function SalvarDados() : void
        {
            if (empty($this->erros) && Login_Session::Verificar_Login()) {
                $entidade = new Object_Entidade();
                
                $entidade->set_site($this->site);
                $entidade->set_nome_comercial($this->nome_comercial);
                $entidade->set_usuario_id(Login_Session::get_usuario_id());
                $entidade->set_imagem($this->Salvar_Imagem());
                
                if (empty($entidade->get_imagem())) {
                    if (DAO_Entidade::Atualizar_Dados($entidade)) {
                        $this->sucessos[] = 'Entidade Atualizada com Sucesso';
                        Login_Session::set_entidade_nome($entidade->get_nome_comercial());
                    } else {
                        $this->erros[] = 'Erro ao tentar Atualizar Entidade';
                    }
                } else {
                    if ($entidade->get_imagem() == 'del') {
                        $entidade->set_imagem(null);
                        Login_Session::set_entidade_imagem(null);
                    }
                    
                    if (DAO_Entidade::Atualizar($entidade)) {
                        $this->sucessos[] = 'Entidade Atualizada com Sucesso';
                        Login_Session::set_entidade_nome($entidade->get_nome_comercial());
                        Login_Session::set_entidade_imagem($entidade->get_imagem());
                    } else {
                        $this->erros[] = 'Erro ao tentar Atualizar Entidade';
                    }
                }
            }
            
            $retorno['erros'] = View_Entidade::CriarListagem($this->erros);
            $retorno['sucessos'] = View_Entidade::CriarListagem($this->sucessos);
            $retorno['campos'] = $this->campos;
            
            echo json_encode($retorno);
        }
        
        /**
         * Function chamada no controller Editar_Dados para salvar os valores do form usuario.
         *
         * @return bool true para sucesso e false para erro ao salvar os dados.
         */
        public function ConcluirCadastro() : bool
        {
            if (Login_Session::Verificar_Login()) {
                if (empty($this->erros)) {
                    $entidade = new Object_Entidade();
                    $entidade->set_usuario_id(Login_Session::get_usuario_id());
                    $entidade->set_status_id(1);
                    $entidade->set_intervalo_pagamento_id(1);
                    $entidade->set_data_contratacao_plano(date('Y-m-d H:i:s'));
                    $entidade->set_plano_id(1);
                    $entidade->set_data(date('Y-m-d H:i:s'));
                    $entidade->set_cpf_cnpj($this->cpf_cnpj);
                    $entidade->set_site($this->site);
                    $entidade->set_nome_comercial($this->nome_comercial);
                    
                    $id_entidade = DAO_Entidade::Inserir($entidade);
                    
                    if ($id_entidade != false) {
                        if (Controller_Faturas::Criar_Fatura($id_entidade, 1)) {
                            Login_Session::set_entidade_id($id_entidade);
                            Login_Session::set_entidade_plano(1);
                            
                            $imagem = $this->Salvar_Imagem();
                            
                            if (!empty($imagem)) {
                                DAO_Entidade::Atualizar_Imagem($imagem, $id_entidade);
                            }
                            
                            return true;
                        } else {
                            $this->erros[] = 'Erro ao tentar gerar fatura';
                            
                            return false;
                        }
                    } else {
                        $this->erros[] = 'Erro ao tentar salvar dados da Entidade';
                        
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        /**
         * Function chamada por ajax para recarregar os valores do form.
         */
        public function CarregarDados() : void
        {
            $entidade['cpf_cnpj'] = '';
            $entidade['nome_comercial'] = '';
            $entidade['site'] = '';
            
            if (Login_Session::Verificar_Login()) {
                $obj_entidade = DAO_Entidade::BuscarPorCOD(Login_Session::get_entidade_id());
                
                if ($obj_entidade instanceof Object_Entidade) {
                    $entidade['cpf_cnpj'] = $obj_entidade->get_cpf_cnpj();
                    $entidade['nome_comercial'] = $obj_entidade->get_nome_comercial();
                    $entidade['site'] = $obj_entidade->get_site();
                }
            }
            
            echo json_encode($entidade);
        }
        
        public function Salvar_Imagem_TMP() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (isset($_FILES['imagem']) AND $_FILES['imagem']['error'] === 0) {
                    $imagens = new Gerenciar_Imagens();
                    
                    $imagens->Armazenar_Imagem_Temporaria($_FILES['imagem']);
                    
                    $_SESSION['imagem_tmp'] = $imagens->get_nome();
                    
                    echo $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
                } else {
                    echo "/resources/img/imagem_indisponivel.png";
                }
            }
        }
        
        /**
         * Remove as imagens da pasta temporaria e seta a session para deletar a imagem salva ao Salvar os Dados
         */
        public function Deletar_Imagem() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (isset($_SESSION['imagem_tmp'])) {
                    if ($_SESSION['imagem_tmp'] != "del") {
                        $imagens = new Gerenciar_Imagens();
                        
                        $imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
                    }
                }
                
                $_SESSION['imagem_tmp'] = "del";
            }
        }
        
        /**
         * Retorna a imagem em formato Base64
         * function usada após carregar as imagens no servidor
         *
         * @param string $nome_imagem
         * @return string
         */
        private static function Pegar_Imagem_URL(?string $nome_imagem = null) : string
        {
            $imagens = new Gerenciar_Imagens();
            
            $caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem_TMP($nome_imagem."-200x150");
            
            if (!empty($caminho_imagem)) {
                return $imagens::Gerar_Data_URL($caminho_imagem);
            } else {
                return "/resources/img/imagem_indisponivel.png";
            }
        }
        
        /**
         * Salva as imagens da pasta temporaria para a pasta real do usuario
         * Function chamada ao Concluir Cadastro
         *
         * @return string|NULL
         */
        private function Salvar_Imagem() : ?string
        {
            if (isset($_SESSION['imagem_tmp'])) {
                $imagens = new Gerenciar_Imagens();
                
                if ($_SESSION['imagem_tmp'] == "del") {
                    $imagens->Deletar_Imagem_Entidade();
                    return "del";
                } else {
                    $img_link = null;
                    
                    if (!empty($this->nome_comercial)) {
                        if (Login_Session::Verificar_Entidade()) {
                            $img_link = $imagens->Atualizar_Imagem_Entidade($_SESSION['imagem_tmp'], Validador::Entidade()::filtrar_descricao_imagem($this->nome_comercial));
                        } else {
                            $img_link = $imagens->Arquivar_Imagem_Entidade($_SESSION['imagem_tmp'], Validador::Entidade()::filtrar_descricao_imagem($this->nome_comercial));
                        }
                    } else {
                        if (Login_Session::Verificar_Entidade()) {
                            $img_link = $imagens->Atualizar_Imagem_Entidade($_SESSION['imagem_tmp']);
                        } else {
                            $img_link = $imagens->Arquivar_Imagem_Entidade($_SESSION['imagem_tmp']);
                        }
                    }
                    
                    unset($_SESSION['imagem_tmp']);
                    return $img_link;
                }
            } else {
                $img_link = null;
                $img_descricao = Validador::Entidade()::filtrar_descricao_imagem($this->nome_comercial);
                
                $imagens = new Gerenciar_Imagens();
                
                if (!empty($img_descricao)) {
                    $img_link = $imagens->Atualizar_Nome_Imagem_Entidade($img_descricao);
                } else {
                    $img_link = $imagens->Atualizar_Nome_Imagem_Entidade();
                }
                
                if (!empty($img_link)) {
                    return $img_link;
                } else {
                    return null;
                }
            }
        }
    }
