<?php
namespace Module\Application\Controller\Usuario;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    use Module\Application\Controller\Common\Util\Email;
    use Module\Application\Controller\Usuario\Login as Controller_Login;
    use Module\Application\View\SRC\Usuario\Cadastro as View_Cadastro;
    use \ReCaptcha\ReCaptcha;
    use \Exception;
    
    class Cadastro
    {
        function __construct()
        {
            
        }
        
        private $nome;
        private $sobrenome;
        private $email;
        private $senha;
        private $recaptcha_response;
        private $cadastro_erros = array();
        private $cadastro_campos = array();
        private $cadastro_form = array();
        
        public function set_nome($nome) : void
        {
            try {
                $this->nome = Validador::Usuario()::validar_nome($nome);
                $this->cadastro_campos['erro_nome'] = "certo";
            } catch (Exception $e) {
                $this->cadastro_erros[] = $e->getMessage();
                $this->cadastro_campos['erro_nome'] = "erro";
                
                $this->nome = Validador::Usuario()::filtrar_nome($nome);
            }
        }
        
        public function set_sobrenome($sobrenome) : void
        {
            try {
                $this->sobrenome = Validador::Usuario()::validar_sobrenome($sobrenome);
                $this->cadastro_campos['erro_sobrenome'] = "certo";
            } catch (Exception $e) {
                $this->cadastro_erros[] = $e->getMessage();
                $this->cadastro_campos['erro_sobrenome'] = "erro";
                
                $this->sobrenome = Validador::Usuario()::filtrar_sobrenome($sobrenome);
            }
        }
        
        public function set_email($email) : void
        {
            try {
                $this->email = Validador::Usuario()::validar_email($email);
                $this->cadastro_campos['erro_email'] = "certo";
            } catch (Exception $e) {
                $this->cadastro_erros[] = $e->getMessage();
                $this->cadastro_campos['erro_email'] = "erro";
                
                $this->email = Validador::Usuario()::filtrar_email($email);
            }
        }
        
        public function set_senha($senha) : void
        {
            try {
                $this->senha = Validador::Usuario()::validar_senha($senha);
                $this->cadastro_campos['erro_senha'] = "certo";
            } catch (Exception $e) {
                $this->cadastro_erros[] = $e->getMessage();
                $this->cadastro_campos['erro_senha'] = "erro";
                
                $this->senha = Validador::Usuario()::filtrar_senha($senha);
            }
        }
        
        public function set_recaptcha_response($recaptcha_response) : void
        {
            try {
                $this->recaptcha_response = Validador::Usuario()::validar_recaptcha_response($recaptcha_response);
                $this->cadastro_campos['erro_recaptcha_response'] = "certo";
            } catch (Exception $e) {
                $this->cadastro_erros[] = $e->getMessage();
                $this->cadastro_campos['erro_recaptcha_response'] = "erro";
                
                $this->recaptcha_response = Validador::Usuario()::filtrar_recaptcha_response($recaptcha_response);
            }
        }
        
        public function Carregar_Pagina() : void
        {
            $view = new View_Cadastro();
            
            $view->set_cadastro_campos($this->cadastro_campos);
            $view->set_cadastro_erros($this->cadastro_erros);
            $view->set_cadastro_form($this->cadastro_form);
             
            $view->Executar();
        }

        public function Cadastrar_Usuario()
        {
            if (empty($this->cadastro_erros)) {
                $recaptcha = new ReCaptcha('6LeGszcUAAAAAG-JTTMkvm1BNiYEo3gKLWDKEQRY');
                
                $resp = $recaptcha->verify($this->recaptcha_response, $_SERVER["REMOTE_ADDR"]);
                
                if ($resp->isSuccess()) {
                    $usuario = new Object_Usuario();
                    $usuario->set_id(0);
                    $usuario->set_ultimo_login(date("Y-m-d H:i:s"));
                    $usuario->set_status_id(2);
                    $usuario->set_fone('00000000');
                    $usuario->set_nome($this->nome);
                    $usuario->set_sobrenome($this->sobrenome);
                    $usuario->set_email($this->email);
                    $usuario->set_senha($this->senha);
                    
                    $usuario->set_senha(password_hash($usuario->get_senha(), PASSWORD_DEFAULT));
                    
                    $retorno = DAO_Usuario::Inserir($usuario);
                    
                    if ($retorno !== false) {
                        Email::Enviar_Boas_Vindas($usuario);
                        
                        $retorno = Controller_Login::Autenticar_Usuario_Logado($usuario->get_email(), $usuario->get_senha());
                        
                        if ($retorno === false) {
                            $this->cadastro_erros[] = "Usuario Cadastrado com Sucesso, porem Autenticação Falhou";
                        }
                    } else {
                        $this->cadastro_erros[] = "Erro ao tentar Cadastrar Usuario";
                    }
                } else {
                    $this->cadastro_erros[] = $resp->getErrorCodes();
                }
            }
            
            if (empty($this->cadastro_erros)) {
                return true;
            } else {
                $this->cadastro_form['nome'] = $this->nome;
                $this->cadastro_form['sobrenome'] = $this->sobrenome;
                $this->cadastro_form['email'] = $this->email;
                $this->cadastro_form['senha'] = $this->senha;
                
                $this->Carregar_Pagina();
            }
        }
        
        public function Cadastrar_Usuario_Ajax() : void
        {
            $retorno_json['status'] = '';
            $retorno_json['content'] = '';
            $retorno_json['campos'] = '';
            
            if (empty($this->cadastro_erros)) {
                $recaptcha = new ReCaptcha('6LeGszcUAAAAAG-JTTMkvm1BNiYEo3gKLWDKEQRY');
                
                $resp = $recaptcha->verify($this->recaptcha_response, $_SERVER["REMOTE_ADDR"]);
                
                if ($resp->isSuccess()) {
                    $usuario = new Object_Usuario();
                    $usuario->set_id(0);
                    $usuario->set_ultimo_login(date("Y-m-d H:i:s"));
                    $usuario->set_status_id(2);
                    $usuario->set_fone('00000000');
                    $usuario->set_nome($this->nome);
                    $usuario->set_sobrenome($this->sobrenome);
                    $usuario->set_email($this->email);
                    $usuario->set_senha($this->senha);
                    
                    $usuario->set_senha(password_hash($usuario->get_senha(), PASSWORD_DEFAULT));
                    
                    $retorno = DAO_Usuario::Inserir($usuario);
                    
                    if ($retorno !== false) {
                        Email::Enviar_Boas_Vindas($usuario);
                        
                        $retorno = Controller_Login::Autenticar_Usuario_Logado($usuario->get_email(), $usuario->get_senha());
                        
                        if ($retorno === false) {
                            $this->cadastro_erros[] = "Usuario Cadastrado com Sucesso, porem Autenticação Falhou";
                        }
                    } else {
                        $this->cadastro_erros[] = "Erro ao tentar Cadastrar Usuario";
                    }
                } else {
                    $this->cadastro_erros[] = $resp->getErrorCodes();
                }
            }
            
            if (empty($this->cadastro_erros)) {
                $retorno_json['status'] = 'certo';
                $retorno_json['content'] = "<li>Cadastro realizado com Sucesso</li>";
            } else {
                $retorno_json['status'] = 'erro';
                $retorno_json['campos'] = $this->cadastro_campos;
                
                foreach ($this->cadastro_erros as $erro) {
                    $retorno_json['content'] .= "<li>$erro</li>";
                }
            }
            
            echo json_encode($retorno_json);
        }
    }
