<?php
namespace Module\Application\Controller\Usuario;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    use Module\Email\Controller\Common\Util\Email;
    use Module\Application\Controller\Usuario\Login as Controller_Login;
    use Module\Application\View\SRC\Usuario\Cadastro as View_Cadastro;
    use \ReCaptcha\ReCaptcha;
    use \Exception;
    
    class Cadastro
    {
        /**
         * @const Codigo de segredo do ReCaptcha.
         */
        private const RC_SECRET = '6LeGszcUAAAAAG-JTTMkvm1BNiYEo3gKLWDKEQRY';
        
        function __construct()
        {
            
        }
        
        private $nome;
        private $sobrenome;
        private $telefone;
        private $email;
        private $senha;
        private $recaptcha_response;
        private $erros = [];
        private $campos = [];
        private $form = [];
        
        public function set_nome($nome) : void
        {
            try {
                $this->nome = Validador::Usuario()::validar_nome($nome);
                $this->campos['erro_nome'] = "certo";
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_nome'] = "erro";
                
                $this->nome = Validador::Usuario()::filtrar_nome($nome);
            }
        }
        
        public function set_sobrenome($sobrenome) : void
        {
            try {
                $this->sobrenome = Validador::Usuario()::validar_sobrenome($sobrenome);
                $this->campos['erro_sobrenome'] = "certo";
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_sobrenome'] = "erro";
                
                $this->sobrenome = Validador::Usuario()::filtrar_sobrenome($sobrenome);
            }
        }
        
        public function set_telefone($telefone) : void
        {
            try {
                $this->telefone = Validador::Usuario()::validar_fone($telefone);
                $this->campos['erro_telefone'] = "certo";
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_telefone'] = "erro";
                
                $this->telefone = Validador::Usuario()::filtrar_fone($telefone);
            }
        }
        
        public function set_email($email) : void
        {
            try {
                $this->email = Validador::Usuario()::validar_email($email);
                $this->campos['erro_email'] = "certo";
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_email'] = "erro";
                
                $this->email = Validador::Usuario()::filtrar_email($email);
            }
        }
        
        public function set_senha($senha) : void
        {
            try {
                $this->senha = Validador::Usuario()::validar_senha($senha);
                $this->campos['erro_senha'] = "certo";
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_senha'] = "erro";
                
                $this->senha = Validador::Usuario()::filtrar_senha($senha);
            }
        }
        
        public function set_recaptcha_response($recaptcha_response) : void
        {
            try {
                $this->recaptcha_response = Validador::Usuario()::validar_recaptcha_response($recaptcha_response);
                $this->campos['erro_recaptcha_response'] = "certo";
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_recaptcha_response'] = "erro";
                
                $this->recaptcha_response = Validador::Usuario()::filtrar_recaptcha_response($recaptcha_response);
            }
        }
        
        public function Carregar_Pagina() : void
        {
            $view = new View_Cadastro();
            
            $view->set_campos($this->campos);
            $view->set_erros($this->erros);
            $view->set_form($this->form);
             
            $view->Executar();
        }

        public function Cadastrar_Usuario()
        {
            if (empty($this->erros)) {
                $recaptcha = new ReCaptcha(self::RC_SECRET);
                
                $resp = $recaptcha->verify($this->recaptcha_response, $_SERVER["REMOTE_ADDR"]);
                
                if ($resp->isSuccess()) {
                    $usuario = new OBJ_Usuario();
                    $usuario->set_id(0);
                    $usuario->set_ultimo_login(date("Y-m-d H:i:s"));
                    $usuario->set_status_id(2);
                    $usuario->set_fone($this->telefone);
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
                            $this->erros[] = "Usuario Cadastrado com Sucesso, porem Autenticação Falhou";
                        }
                    } else {
                        $this->erros[] = "Erro ao tentar Cadastrar Usuario";
                    }
                } else {
                    $this->erros[] = $resp->getErrorCodes();
                }
            }
            
            if (empty($this->erros)) {
                return true;
            } else {
                $this->form['nome'] = $this->nome;
                $this->form['sobrenome'] = $this->sobrenome;
                $this->form['telefone'] = $this->telefone;
                $this->form['email'] = $this->email;
                $this->form['senha'] = $this->senha;
                
                $this->Carregar_Pagina();
            }
        }
        
        public function Cadastrar_Usuario_Ajax() : void
        {
            $retorno_json['status'] = '';
            $retorno_json['content'] = '';
            $retorno_json['campos'] = '';
            
            if (empty($this->erros)) {
                $recaptcha = new ReCaptcha(self::RC_SECRET);
                
                $resp = $recaptcha->verify($this->recaptcha_response, $_SERVER["REMOTE_ADDR"]);
                
                if ($resp->isSuccess()) {
                    $usuario = new OBJ_Usuario();
                    $usuario->set_id(0);
                    $usuario->set_ultimo_login(date("Y-m-d H:i:s"));
                    $usuario->set_status_id(2);
                    $usuario->set_fone($this->telefone);
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
                            $this->erros[] = "Usuario Cadastrado com Sucesso, porem Autenticação Falhou";
                        }
                    } else {
                        $this->erros[] = "Erro ao tentar Cadastrar Usuario";
                    }
                } else {
                    $this->erros[] = $resp->getErrorCodes();
                }
            }
            
            if (empty($this->erros)) {
                $retorno_json['status'] = 'certo';
                $retorno_json['content'] = "<li>Cadastro realizado com Sucesso</li>";
            } else {
                $retorno_json['status'] = 'erro';
                $retorno_json['campos'] = $this->campos;
                
                foreach ($this->erros as $erro) {
                    $retorno_json['content'] .= "<li>$erro</li>";
                }
            }
            
            echo json_encode($retorno_json);
        }
    }
