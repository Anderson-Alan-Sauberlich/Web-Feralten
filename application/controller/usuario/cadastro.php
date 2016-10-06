<?php
namespace application\controller\usuario;

    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/controller/usuario/login.php';
    require_once RAIZ.'/application/view/src/usuario/cadastro.php';

    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\object\Usuario as Object_Usuario;
    use application\controller\usuario\Login;
    use application\view\src\usuario\Cadastro as View_Cadastro;
    
    @session_start();

    class Cadastro {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Cadastro();
        }

        public function Cadastrar_Usuario() {
            $erros_cadastrar = array();
            $cad_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' => "certo", 'erro_senha' => "certo");

            $usuario = new Object_Usuario();
            
            if (empty($_POST['nome'])) {
            	$erros_cadastrar[] = "Digite Seu Nome Completo";
            	$cad_campos['erro_nome'] = "erro";
            } else {
            	$nome = strip_tags($_POST['nome']);
            	
            	if ($nome === $_POST['nome']) {
	            	$nome = trim($nome);
	            	$nome = preg_replace('/\s+/', " ", $nome);
	            	
	            	if (strlen($nome) <= 150) {
	            		if (preg_match("/^([a-zA-Z0-9çÇ ,'-]+)$/", $nome)) {
	            			$usuario->set_nome(ucwords(strtolower($nome)));
	            		} else {
	            			$erros_cadastrar[] = "O Nome Não Pode Conter Caracteres Especiais";
	            			$cad_campos['erro_nome'] = "erro";
	            		}
	            	} else {
	            		$erros_cadastrar[] = "O Nome pode ter no maximo 150 Caracteres";
	            		$cad_campos['erro_nome'] = "erro";
	            	}
            	} else {
            		$erros_cadastrar[] = "O Nome Não pode conter Tags de Programação";
            		$cad_campos['erro_nome'] = "erro";
            	}
            }
            
            if (empty($_POST['password'])) {
            	$erros_cadastrar[] = "Preencha o Campo Senha";
            	$cad_campos['erro_senha'] = "erro";
            } else {
	            if (strlen($_POST['password']) >= 6 AND strlen($_POST['password']) <= 20) {
	            	$password = strip_tags($_POST['password']);
	            	 
	            	if ($password === $_POST['password']) {
	            		$usuario->set_senha($password);
	            	} else {
	            		$erros_cadastrar[] = "A Senha Não pode conter Tags de Programação";
	            		$cad_campos['erro_senha'] = "erro";
	            	}
	            } else {
	            	$erros_cadastrar[] = "A Senha Deve conter de 6 a 20 caracteres";
	            	$cad_campos['erro_senha'] = "erro";
	            }
            }
	        
	        if (empty($_POST['confemail']) OR empty($_POST['email'])) {
	        	if (empty($_POST['email'])) {
	        		$erros_cadastrar[] = "Preencha o Campo E-Mail";
	        		$cad_campos['erro_email'] = "erro";
	        	}
	        	 
	        	if (empty($_POST['confemail'])) {
	        		$erros_cadastrar[] = "Preencha o Campo Comfirmar E-Mail";
	        		$cad_campos['erro_confemail'] = "erro";
	        	}
	        } else {
	        	$confemail = trim($_POST['confemail']);
	        	$email = trim($_POST['email']);
	        	
	        	if ($confemail === $email) {
	        		if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
		        		if (DAO_Usuario::Verificar_Email($email) === 0) {
		        			if (strlen($email) <= 150) {
		        				$usuario->set_email($email);
		        			} else {
		        				$erros_cadastrar[] = "O E-Mail pode ter no maximo 150 Caracteres";
		        				$cad_campos['erro_email'] = "erro";
		        				$cad_campos['erro_confemail'] = "erro";
		        			}
		        		} else {
		        			$erros_cadastrar[] = "Este E-Mail Já Esta Cadastrado";
		        			$cad_campos['erro_email'] = "erro";
		        			$cad_campos['erro_confemail'] = "erro";
		        		}
	        		} else {
	        			$erros_cadastrar[] = "Este E-Mail Não é Valido";
	        			$cad_campos['erro_email'] = "erro";
	        			$cad_campos['erro_confemail'] = "erro";
	        		}
	        	} else {
	        		$erros_cadastrar[] = "Digite o E-Mails Duas Vezes Igualmente";
	        		$cad_campos['erro_email'] = "erro";
	        		$cad_campos['erro_confemail'] = "erro";
	        	}
	        }
            
            if (empty($erros_cadastrar)) {
            	$usuario->set_id(0);
            	$usuario->set_ultimo_login(date("Y-m-d H:i:s"));
            	
            	$usuario->set_senha(password_hash($usuario->get_senha(), PASSWORD_DEFAULT));
            	
                DAO_Usuario::Inserir($usuario);
				
                Login::Autenticar_Usuario_Logado($usuario->get_email(), $usuario->get_senha());
                
                return true;
            } else {
                $_SESSION['erros_cadastrar'] = $erros_cadastrar;
                $_SESSION['cad_campos'] = $cad_campos;
                
                $form_cadastro = array();
                
                $form_cadastro['nome'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['nome'])))));
                $form_cadastro['email'] = trim(strip_tags($_POST['email']));
                $form_cadastro['confemail'] = trim(strip_tags($_POST['confemail']));
                $form_cadastro['senha'] = strip_tags($_POST['password']);
                
                $_SESSION['form_cadastro'] = $form_cadastro;
                
                return false;
            }
        }
    }
?>