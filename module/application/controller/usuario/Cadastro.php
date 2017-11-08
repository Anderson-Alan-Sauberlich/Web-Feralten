<?php
namespace module\application\controller\usuario;
	
    use module\application\model\common\util\Validador;
    use module\application\model\dao\Usuario as DAO_Usuario;
    use module\application\model\object\Usuario as Object_Usuario;
    use module\application\controller\common\util\Email;
    use module\application\controller\usuario\Login as Controller_Login;
    use module\application\view\src\usuario\Cadastro as View_Cadastro;
    use \ReCaptcha\ReCaptcha;
    use \Exception;
    
    class Cadastro {
		
        function __construct() {
            
        }
        
        private $nome;
        private $email;
        private $senha;
        private $recaptcha_response;
        private $cadastro_erros = array();
        private $cadastro_campos = array();
        private $cadastro_form = array();
        
        public function set_nome($nome) {
        	try {
        		$this->nome = Validador::Usuario()::validar_nome($nome);
        		$this->cadastro_campos['erro_nome'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_nome'] = "erro";
        		
        		$this->nome = Validador::Usuario()::filtrar_nome($nome);
        	}
        }
        
        public function set_email($email) {
        	try {
        		$this->email = Validador::Usuario()::validar_email($email);
        		$this->cadastro_campos['erro_email'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_email'] = "erro";
        		
        		$this->email = Validador::Usuario()::filtrar_email($email);
        	}
        }
        
        public function set_senha($senha) {
        	try {
        		$this->senha = Validador::Usuario()::validar_senha($senha);
        		$this->cadastro_campos['erro_senha'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_senha'] = "erro";
        		
        		$this->senha = Validador::Usuario()::filtrar_senha($senha);
        	}
        }
        
        public function set_recaptcha_response($recaptcha_response) {
            try {
                $this->recaptcha_response = Validador::Usuario()::validar_recaptcha_response($recaptcha_response);
                $this->cadastro_campos['erro_recaptcha_response'] = "certo";
            } catch (Exception $e) {
                $this->cadastro_erros[] = $e->getMessage();
                $this->cadastro_campos['erro_recaptcha_response'] = "erro";
                
                $this->recaptcha_response = Validador::Usuario()::filtrar_recaptcha_response($recaptcha_response);
            }
        }
        
        public function Carregar_Pagina() : void {
        	$view = new View_Cadastro();
        	
        	$view->set_cadastro_campos($this->cadastro_campos);
        	$view->set_cadastro_erros($this->cadastro_erros);
        	$view->set_cadastro_form($this->cadastro_form);
        	 
        	$view->Executar();
        }

        public function Cadastrar_Usuario() {
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
                $this->cadastro_form['email'] = $this->email;
                $this->cadastro_form['senha'] = $this->senha;
                
                $this->Carregar_Pagina();
            }
        }
    }
?>