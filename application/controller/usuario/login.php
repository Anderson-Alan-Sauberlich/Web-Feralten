<?php
namespace application\controller\usuario;

    require_once(RAIZ.'/application/model/dao/usuario.php');
    require_once(RAIZ.'/application/model/object/usuario.php');
    require_once(RAIZ.'/application/view/src/usuario/login.php');

    use application\model\object\Usuario as Object_Usuario;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\view\src\usuario\Login as View_Login;

    @session_start();

    class Login {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Login();
        }
		
		public static function Autenticar_Usuario_Cookie($id_usuario, $token) {
			$usuario_login = DAO_Usuario::Buscar_Usuario($id_usuario);
			
			if (hash_equals($token, hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token())))) {
            	$usuario_login->set_senha(hash_hmac('sha512', $senha, hash('sha512', serialize($usuario_login))));
				$usuario_login->set_ultimo_login(date("Y-m-d H:i:s"));
				$usuario_login->set_token(null);
				
				$_SESSION['usuario'] = serialize($usuario_login);
				
                $login = array();
				
				$usuario_login->set_token(random_bytes(40));
				
				$login['usuario'] = $usuario_login->get_id();
				$login['token'] = hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token()));
				
                setcookie("f_m_l", serialize($login), (time() + (7 * 24 * 3600)), "/");
                
				DAO_Usuario::Atualizar_Token_Ultimo_Login($usuario_login->get_token(), $usuario_login->get_ultimo_login(), $usuario_login->get_id());
				
				return true;
			} else {
				return false;
			}
		}
		
        public static function Autenticar_Usuario_Logado($email, $senha) {
        	$usuario_login = DAO_Usuario::Autenticar($email);
            
            if (!empty($usuario_login)) {
            	if (hash_equals($senha, $usuario_login->get_senha())) {
            		$usuario_login->set_senha(hash_hmac('sha512', $senha, hash('sha512', serialize($usuario_login))));
					
					$_SESSION['usuario'] = serialize($usuario_login);
            	}
            }
        }
		
		public static function Apagar_Token($usuario_id) {
			DAO_Usuario::Atualizar_Token(null, $usuario_id);
		}

        public static function Autenticar_Usuario_Login($email, $senha, $manter_login) {
            $login_campos = array();
            $login_erros = array();
            
            if (empty($email)){
                $login_erros[] = "Digite seu Email.";
                $login_campos['erro_email'] = "erro";
                if (empty($senha)) {
                    $login_erros[] = "Digite sua Senha.";
                    $login_campos['erro_senha'] = "erro";
                }
            } else if (DAO_Usuario::Verificar_Email($email) <= 0) {
                $login_erros[] = "Email não Cadastrado.";
                $login_campos['erro_email'] = "erro";
            } else if (empty($senha)) {
                $login_campos['erro_email'] = "certo";
                $login_erros[] = "Digite sua Senha.";
                $login_campos['erro_senha'] = "erro";
            }

            if (empty($login_erros)) {
                $usuario_login = DAO_Usuario::Autenticar($email);
                
                if (!empty($usuario_login) AND password_verify($senha, $usuario_login->get_senha())) {
                    $usuario_login->set_senha(hash_hmac('sha512', $senha, hash('sha512', $senha)));
					$usuario_login->set_ultimo_login(date("Y-m-d H:i:s"));
					
                    $_SESSION['usuario'] = serialize($usuario_login);
                    
                    if (isset($manter_login)) {
                    	$login = array();
						
						$usuario_login->set_token(random_bytes(40));
						
						$login['usuario'] = $usuario_login->get_id();
						$login['token'] = hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token()));
						
                        setcookie("f_m_l", serialize($login), (time() + (7 * 24 * 3600)), "/");
                        
						DAO_Usuario::Atualizar_Token_Ultimo_Login($usuario_login->get_token(), $usuario_login->get_ultimo_login(), $usuario_login->get_id());
                    } else {
                    	DAO_Usuario::Atualizar_Ultimo_Login($usuario_login->get_ultimo_login(), $usuario_login->get_id());
                    }
                } else {
                    $login_erros[] = "Senha Incorreta.";
                    $login_campos['erro_senha'] = "erro";
                    $login_campos['erro_email'] = "certo";
                    setcookie("f_m_l", null, time()-3600, "/");
                    $_SESSION['login_erros'] = $login_erros;
                    $_SESSION['login_campos'] = $login_campos;
                }
            } else {
                setcookie("f_m_l", null, time()-3600, "/");
                $_SESSION['login_erros'] = $login_erros;
                $_SESSION['login_campos'] = $login_campos;
            }
        }
    }
?>