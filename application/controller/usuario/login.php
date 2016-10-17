<?php
namespace application\controller\usuario;

    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/view/src/usuario/login.php';

    use application\model\dao\Usuario as DAO_Usuario;
    use application\view\src\usuario\Login as View_Login;

    @session_start();

    class Login {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina($login_erros = null, $login_campos = null, $login_form = null) {
        	$view = new View_Login();
        	
        	$view->set_login_campos($login_campos);
        	$view->set_login_erros($login_erros);
        	$view->set_login_form($login_form);
        	
        	$view->Executar();
        }
        
        public static function LogOut() {
        	if (isset($_GET['logout'])) {
	        	if(hash_equals($_GET['logout'], hash_hmac('sha1', session_id(), sha1(session_id())))) {
	        		if (isset($_COOKIE['f_m_l'])) {
	        			if (isset($_SESSION['usuario'])) {
	        				DAO_Usuario::Atualizar_Token(null, unserialize($_SESSION['usuario'])->get_id());
	        			}
	        			 
	        			setcookie("f_m_l", null, time()-3600, "/");
	        		}
	        
	        		unset($_SESSION['usuario']);
	        		$_SESSION['login_sucesso'][] = "LogOut efetuado com Sucesso";
	        	}
        	}
        }
		
		public static function Autenticar_Usuario_Cookie($id_usuario, $token) {
			$usuario_login = DAO_Usuario::Buscar_Usuario($id_usuario);
			
			if ($usuario_login !== false) {
				if (hash_equals($token, hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token())))) {
	            	$usuario_login->set_senha(hash_hmac('sha512', $usuario_login->get_senha(), hash('sha512', $usuario_login->get_senha())));
					$usuario_login->set_ultimo_login(date("Y-m-d H:i:s"));
					$usuario_login->set_token(null);
					
					$_SESSION['usuario'] = serialize($usuario_login);
					
	                $login = array();
					
					$usuario_login->set_token(random_bytes(40));
					
					$login['usuario'] = $usuario_login->get_id();
					$login['token'] = hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token()));
					
	                setcookie("f_m_l", serialize($login), (time() + (7 * 24 * 3600)), "/");
	                
					$retorno = DAO_Usuario::Atualizar_Token_Ultimo_Login($usuario_login->get_token(), $usuario_login->get_ultimo_login(), $usuario_login->get_id());
					
					if ($retorno === false) {
						return false;
					} else {
						return true;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		
        public static function Autenticar_Usuario_Logado($email, $senha) {
        	$usuario_login = DAO_Usuario::Autenticar($email);
            
            if (!empty($usuario_login) AND $usuario_login !== false) {
            	if (hash_equals($senha, $usuario_login->get_senha())) {
            		$usuario_login->set_senha(hash_hmac('sha512', $senha, hash('sha512', $usuario_login->get_senha())));
					
					$_SESSION['usuario'] = serialize($usuario_login);
					
					return true;
            	} else {
            		false;
            	}
            } else {
            	return false;
            }
        }

        public static function Autenticar_Usuario_Login() {
            $login_campos = array('erro_email' => "certo");
            $login_erros = array();
            $email = null;
            $senha = null;
            $manter_login = null;
            
            if (empty($_POST['email'])) {
                $login_erros[] = "Digite seu Email";
                $login_campos['erro_email'] = "erro";                
            } else {
            	$email = trim($_POST['email']);
            	
            	if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            		$retorno = DAO_Usuario::Verificar_Email($email);
            		
            		if ($retorno !== false) {
		            	if ($retorno <= 0) {
			                $login_erros[] = "Email não Cadastrado";
			                $login_campos['erro_email'] = "erro";
		            	}
            		} else {
            			$login_erros[] = "Erro ao tentar Encontrar E-Mail";
            			$login_campos['erro_email'] = "";
            		}
            	} else {
            		$login_erros[] = "Este E-Mail Não é Valido";
		            $login_campos['erro_email'] = "erro";
            	}
            }
            
            if (empty($_POST['password'])) {
                $login_erros[] = "Digite sua Senha";
                $login_campos['erro_senha'] = "erro";
            } else {
            	$senha = strip_tags($_POST['password']);
            	 
            	if ($senha !== $_POST['password']) {
            		$login_erros[] = "A Senha Não pode conter Tags de Programação";
            		$login_campos['erro_senha'] = "erro";
            	}
            }
            
            if (!empty($_POST['manter_login'])) {
            	$manter_login = true;
            }

            if (empty($login_erros)) {
                $usuario_login = DAO_Usuario::Autenticar($email);
                
                if ($usuario_login !== false) {
		            if (password_verify($senha, $usuario_login->get_senha())) {
		                $usuario_login->set_senha(hash_hmac('sha512', $senha, hash('sha512', $senha)));
						$usuario_login->set_ultimo_login(date("Y-m-d H:i:s"));
						
		                $_SESSION['usuario'] = serialize($usuario_login);
		                
		                if (isset($manter_login)) {
		                    $login = array();
							
							$usuario_login->set_token(random_bytes(40));
							
							$login['usuario'] = $usuario_login->get_id();
							$login['token'] = hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token()));
							
		                    setcookie("f_m_l", serialize($login), (time() + (7 * 24 * 3600)), "/");
		                    
							$retorno = DAO_Usuario::Atualizar_Token_Ultimo_Login($usuario_login->get_token(), $usuario_login->get_ultimo_login(), $usuario_login->get_id());
		                	
							if ($retorno === false) {
								$login_erros[] = "Erro ao tentar Atualizar Usuario";
							}
		                } else {
		                    $retorno = DAO_Usuario::Atualizar_Ultimo_Login($usuario_login->get_ultimo_login(), $usuario_login->get_id());
		                	
		                    if ($retorno === false) {
		                    	$login_erros[] = "Erro ao tentar Atualizar Usuario";
		                    }
		                }
		            } else {
		                $login_erros[] = "Senha Incorreta";
		                $login_campos['erro_senha'] = "erro";
		            }
                } else {
                	$login_erros[] = "Erro ao tentar Autenticar Usuario";
                }
            }
            
            if (empty($login_erros)) {
            	return true;
            } else {
            	setcookie("f_m_l", null, time()-3600, "/");
            	
            	$login_form = array();
            	
            	$login_form['email'] = trim(strip_tags($email));
            	$login_form['senha'] = strip_tags($senha);
            	
            	self::Carregar_Pagina($login_erros, $login_campos, $login_form);
            }
        }
    }
?>