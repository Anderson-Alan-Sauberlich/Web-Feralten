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
    
    class Cadastro {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina($cadastro_erros = null, $cadastro_campos = null, $cadastro_form = null) {
        	$view = new View_Cadastro();
        	
        	$view->set_cadastro_campos($cadastro_campos);
        	$view->set_cadastro_erros($cadastro_erros);
        	$view->set_cadastro_form($cadastro_form);
        	 
        	$view->Executar();
        }

        public function Cadastrar_Usuario() {
            $cadastro_erros = array();
            $cadastro_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' => "certo", 'erro_senha' => "certo");

            $usuario = new Object_Usuario();
            
            if (empty($_POST['nome'])) {
            	$cadastro_erros[] = "Digite Seu Nome Completo";
            	$cadastro_campos['erro_nome'] = "erro";
            } else {
            	$nome = strip_tags($_POST['nome']);
            	
            	if ($nome === $_POST['nome']) {
	            	$nome = trim($nome);
	            	$nome = preg_replace('/\s+/', " ", $nome);
	            	
	            	if (strlen($nome) <= 150) {
	            		if (preg_match("/^([a-zA-Z0-9çÇ ,'-]+)$/", $nome)) {
	            			$usuario->set_nome(ucwords(strtolower($nome)));
	            		} else {
	            			$cadastro_erros[] = "O Nome Não Pode Conter Caracteres Especiais";
	            			$cadastro_campos['erro_nome'] = "erro";
	            		}
	            	} else {
	            		$cadastro_erros[] = "O Nome pode ter no maximo 150 Caracteres";
	            		$cadastro_campos['erro_nome'] = "erro";
	            	}
            	} else {
            		$cadastro_erros[] = "O Nome Não pode conter Tags de Programação";
            		$cadastro_campos['erro_nome'] = "erro";
            	}
            }
            
            if (empty($_POST['password'])) {
            	$cadastro_erros[] = "Preencha o Campo Senha";
            	$cadastro_campos['erro_senha'] = "erro";
            } else {
	            if (strlen($_POST['password']) >= 6 AND strlen($_POST['password']) <= 20) {
	            	$password = strip_tags($_POST['password']);
	            	 
	            	if ($password === $_POST['password']) {
	            		$usuario->set_senha($password);
	            	} else {
	            		$cadastro_erros[] = "A Senha Não pode conter Tags de Programação";
	            		$cadastro_campos['erro_senha'] = "erro";
	            	}
	            } else {
	            	$cadastro_erros[] = "A Senha Deve conter de 6 a 20 caracteres";
	            	$cadastro_campos['erro_senha'] = "erro";
	            }
            }
	        
	        if (empty($_POST['confemail']) OR empty($_POST['email'])) {
	        	if (empty($_POST['email'])) {
	        		$cadastro_erros[] = "Preencha o Campo E-Mail";
	        		$cadastro_campos['erro_email'] = "erro";
	        	}
	        	 
	        	if (empty($_POST['confemail'])) {
	        		$cadastro_erros[] = "Preencha o Campo Comfirmar E-Mail";
	        		$cadastro_campos['erro_confemail'] = "erro";
	        	}
	        } else {
	        	$confemail = trim($_POST['confemail']);
	        	$email = trim($_POST['email']);
	        	
	        	if ($confemail === $email) {
	        		if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
	        			if (strlen($email) <= 150) {
		        			$retorno = DAO_Usuario::Verificar_Email($email);
		        			
			        		if ($retorno !== false) {
			        			if ($retorno === 0) {
				        			$usuario->set_email($email);
				        		} else {
				        			$cadastro_erros[] = "Este E-Mail Já Esta Cadastrado";
				        			$cadastro_campos['erro_email'] = "erro";
				        			$cadastro_campos['erro_confemail'] = "erro";
				        		}
			        		} else {
			        			$cadastro_erros[] = "Erro ao tentar Encontrar E-Mail";
			        			$cadastro_campos['erro_email'] = "";
			        			$cadastro_campos['erro_confemail'] = "";
			        		}
		        		} else {
		        			$cadastro_erros[] = "O E-Mail pode ter no maximo 150 Caracteres";
		        			$cadastro_campos['erro_email'] = "erro";
		        			$cadastro_campos['erro_confemail'] = "erro";
		        		}
	        		} else {
	        			$cadastro_erros[] = "Este E-Mail Não é Valido";
	        			$cadastro_campos['erro_email'] = "erro";
	        			$cadastro_campos['erro_confemail'] = "erro";
	        		}
	        	} else {
	        		$cadastro_erros[] = "Digite o E-Mails Duas Vezes Igualmente";
	        		$cadastro_campos['erro_email'] = "erro";
	        		$cadastro_campos['erro_confemail'] = "erro";
	        	}
	        }
            
            if (empty($cadastro_erros)) {
            	$usuario->set_id(0);
            	$usuario->set_ultimo_login(date("Y-m-d H:i:s"));
            	
            	$usuario->set_senha(password_hash($usuario->get_senha(), PASSWORD_DEFAULT));
            	
                $retorno = DAO_Usuario::Inserir($usuario);
				
                if ($retorno !== false) {
                	$retorno = Login::Autenticar_Usuario_Logado($usuario->get_email(), $usuario->get_senha());
                	
                	if ($retorno === false) {
                		$cadastro_erros[] = "Usuario Cadastrado com Sucesso, porem Autenticação Falhou";
                	}
                } else {
                	$cadastro_erros[] = "Erro ao tentar Cadastrar Usuario";
                }
            }
            
            if (empty($cadastro_erros)) {
            	return true;
            } else {
                $cadastro_form = array();
                
                $cadastro_form['nome'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['nome'])))));
                $cadastro_form['email'] = trim(strip_tags($_POST['email']));
                $cadastro_form['confemail'] = trim(strip_tags($_POST['confemail']));
                $cadastro_form['senha'] = strip_tags($_POST['password']);
                
                self::Carregar_Pagina($cadastro_erros, $cadastro_campos, $cadastro_form);
            }
        }
    }
?>