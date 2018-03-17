<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados as View_Editar_Dados;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Usuario as View_Usuario;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade as View_Entidade;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco as View_Endereco;
    use Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco as Controller_Endereco;
    use Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade as Controller_Entidade;
    use Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Usuario as Controller_Usuario;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Controller\Usuario\Login as Controller_Login;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Conexao;
    
    class Editar_Dados
    {
        /**
         * Inicializa as variaveis com os objetos
         * 
         * $controller_usuario Controller_Usuario
         * $controller_entidade Controller_Entidade
         * $controller_endereco Controller_Endereco
         */
        function __construct()
        {
            $this->controller_usuario = new Controller_Usuario();
            $this->controller_entidade = new Controller_Entidade();
            $this->controller_endereco = new Controller_Endereco();
        }
        
        /**
         * Armazena o objeto do controller usuario
         * 
         * @var Controller_Usuario
         */
        private $controller_usuario;
        
        /**
         * Armazena o objeto do controller entidade
         * 
         * @var Controller_Entidade
         */
        private $controller_entidade;
        
        /**
         * Armazena o objeto do controller endereço
         * 
         * @var Controller_Endereco
         */
        private $controller_endereco;
        
        /**
         * @param string $nome
         */
        public function set_nome($nome) : void
        {
            $this->controller_usuario->set_nome($nome);
        }
        
        /**
         * @param string $sobrenome
         */
        public function set_sobrenome($sobrenome) : void
        {
            $this->controller_usuario->set_sobrenome($sobrenome);
        }
        
        /**
         * @param string $fone
         */
        public function set_fone($fone) : void
        {
            $this->controller_usuario->set_fone($fone);
        }
        
        /**
         * @param string $email
         */
        public function set_email($email) : void
        {
            $this->controller_usuario->set_email($email);
        }
        
        /**
         * @param string $fone_alternativo
         */
        public function set_fone_alternativo($fone_alternativo = null) : void
        {
            $this->controller_usuario->set_fone_alternativo($fone_alternativo);
        }
        
        /**
         * @param string $email_alternativo
         */
        public function set_email_alternativo($email_alternativo = null) : void
        {
            $this->controller_usuario->set_email_alternativo($email_alternativo);
        }
        
        /**
         * @param string $cpf_cnpj
         */
        public function set_cpf_cnpj($cpf_cnpj) : void
        {
            $this->controller_entidade->set_cpf_cnpj($cpf_cnpj);
        }
        
        /**
         * @param string $site
         */
        public function set_site($site = null) : void
        {
            $this->controller_entidade->set_site($site);
        }
        
        /**
         * @param string $nome_comercial
         */
        public function set_nome_comercial($nome_comercial = null) : void
        {
            $this->controller_entidade->set_nome_comercial($nome_comercial);
        }
        
        /**
         * @param int $estado
         */
        public function set_estado($estado) : void
        {
            $this->controller_endereco->set_estado($estado);
        }
        
        /**
         * @param int $cidade
         */
        public function set_cidade($cidade) : void
        {
            $this->controller_endereco->set_cidade($cidade);
        }
        
        /**
         * @param string $numero
         */
        public function set_numero($numero) : void
        {
            $this->controller_endereco->set_numero($numero);
        }
        
        /**
         * @param string $cep
         */
        public function set_cep($cep) : void
        {
            $this->controller_endereco->set_cep($cep);
        }
        
        /**
         * @param string $bairro
         */
        public function set_bairro($bairro) : void
        {
            $this->controller_endereco->set_bairro($bairro);
        }
        
        /**
         * @param string $rua
         */
        public function set_rua($rua) : void
        {
            $this->controller_endereco->set_rua($rua);
        }
        
        /**
         * @param string $complemento
         */
        public function set_complemento($complemento = null) : void
        {
            $this->controller_endereco->set_complemento($complemento);
        }
        
        /**
         * Instancia e Abre a View
         *
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                $view = new View_Editar_Dados($status);
                
                $view->set_view_usuario($this->controller_usuario->Retornar_Pagina());
                $view->set_view_entidade($this->controller_entidade->Retornar_Pagina());
                $view->set_view_endereco($this->controller_endereco->Retornar_Pagina());
                
                $view->Executar();
                
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Salva os dados do usuario
         */
        public function Concluir_Cadastro() : void
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                if ($status == 0) {
                    $retorno['usuario']['erros'] = [];
                    $retorno['usuario']['campos'] = [];
                    
                    $retorno['entidade']['erros'] = [];
                    $retorno['entidade']['campos'] = [];
                    
                    $retorno['endereco']['erros'] = [];
                    $retorno['endereco']['campos'] = [];
                    
                    Conexao::Conectar()->beginTransaction();
                    
                    if ($this->controller_usuario->ConcluirCadastro()) {
                        if ($this->controller_entidade->ConcluirCadastro()) {
                            if ($this->controller_endereco->ConcluirCadastro()) {
                                if (Conexao::$conection->commit()) {
                                    Controller_Login::ReAutenticar_Usuario_Logado(Login_Session::get_usuario_id());
                                } else {
                                    Login_Session::Finalizar_Login_Session_Entidade();
                                    Conexao::$conection->rollBack();
                                    $retorno['usuario']['erros'][] = 'Erro Fatal, tenta novamente mais tarde';
                                    $retorno['entidade']['erros'][] = 'Erro Fatal, tenta novamente mais tarde';
                                    $retorno['endereco']['erros'][] = 'Erro Fatal, tenta novamente mais tarde';
                                }
                            } else {
                                Login_Session::Finalizar_Login_Session_Entidade();
                                if (!Conexao::$conection->rollBack()) {
                                    $retorno['endereco']['erro'][] = 'Erro Fatal ao tentar salvar dados do Endereço';
                                }
                            }
                        } else {
                            Login_Session::Finalizar_Login_Session_Entidade();
                            if (!Conexao::$conection->rollBack()) {
                                $retorno['entidade']['erros'][] = 'Erro Fatal ao tentar salvar dados da Entidade';
                            }
                        }
                    } else {
                        Login_Session::Finalizar_Login_Session_Entidade();
                        if (!Conexao::$conection->rollBack()) {
                            $retorno['usuario']['erros'][] = 'Erro Fatal ao tentar salvar dados do Usuario';
                        }
                    }
                    
                    $retorno['usuario']['erros'] = View_Usuario::CriarListagem(array_merge($this->controller_usuario->get_erros(), $retorno['usuario']['erros']));
                    $retorno['usuario']['campos'] = array_merge($this->controller_usuario->get_campos(), $retorno['usuario']['campos']);
                    
                    $retorno['entidade']['erros'] = View_Entidade::CriarListagem(array_merge($this->controller_entidade->get_erros(), $retorno['entidade']['erros']));
                    $retorno['entidade']['campos'] = array_merge($this->controller_entidade->get_campos(), $retorno['entidade']['campos']);
                    
                    $retorno['endereco']['erros'] = View_Endereco::CriarListagem(array_merge($this->controller_endereco->get_erros(), $retorno['endereco']['erros']));
                    $retorno['endereco']['campos'] = array_merge($this->controller_endereco->get_campos(), $retorno['endereco']['campos']);
                    
                    echo json_encode($retorno);
                }
            }
            
            
        }
    }
