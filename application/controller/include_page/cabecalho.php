<?php
namespace application\controller\include_page;

    require_once(RAIZ.'/application/model/object/class_usuario.php');
    require_once(RAIZ.'/application/controller/usuario/login.php');

    use application\model\object\Usuario;
    use application\controller\usuario\Login;

    @session_start();

    class Cabecalho {

        function __construct() {
            
        }
        
        public static function LogOut($logout_id) {
            if(hash_equals($logout_id, hash_hmac('sha1', session_id(), sha1(session_id())))) {
                if (isset($_COOKIE['f_m_l'])) {
                	if (isset($_SESSION['usuario'])) {
                		Login::Apagar_Token(unserialize($_SESSION['usuario'])->get_id());
                	}
                	
					setcookie("f_m_l", null, time()-3600, "/");
                }
                
				unset($_SESSION['usuario']);
                $_SESSION['login_success'][] = "LogOut efetuado com Sucesso!";
                header("location: /usuario/login/");
            }
            else {
                header("location: /");
            }
        }
		
		public static function Verificar_Cookie($login) {
			return Login::Autenticar_Usuario_Cookie($login['usuario'], $login['token']);
		}
    }
?>