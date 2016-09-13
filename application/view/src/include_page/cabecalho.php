<?php
namespace application\view\src\include_page;

	require_once(RAIZ.'/application/controller/include_page/cabecalho.php');

	use application\controller\include_page\Cabecalho as Controller_Cabecalho;

    @session_start();

    class Cabecalho {

        function __construct() {
        	ob_start();
			
            if (isset($_GET['logout'])) {
            	Controller_Cabecalho::LogOut($_GET['logout']);
            }
        }
        
        public static function Verificar_Usuario_Autenticado() {
        	if (isset($_SESSION['usuario'])) {
        		echo "<li><a href=\"/usuario/meu-perfil/\"><i class=\"menu-yellow\"><i class=\"user icon\"></i>MEU PERFIL</i></a></li>";
				echo "<li><a href=\"/cabecalho/?logout=".hash_hmac('sha1', session_id(), sha1(session_id()))."\"><i class=\"sign out icon\"></i>SAIR</a></li>";
        	} else if (isset($_COOKIE['f_m_l'])) {
        		$login = unserialize($_COOKIE['f_m_l']);
				
				if (isset($login['usuario']) AND isset($login['token'])) {
					if (Controller_Cabecalho::Verificar_Cookie($login)) {
        				echo "<li><a href=\"/usuario/meu-perfil/\"><i class=\"menu-yellow\"><i class=\"user icon\"></i>MEU PERFIL</i></a></li>";
						echo "<li><a href=\"/cabecalho/?logout=".hash_hmac('sha1', session_id(), sha1(session_id()))."\"><i class=\"sign out icon\"></i>SAIR</a></li>";
					} else {
                		echo "<li><a href=\"/usuario/cadastro/\"><i class=\"menu-yellow\"><i class=\"user icon\"></i>CADASTRAR</i></a></li>";
                		echo "<li><a href=\"/usuario/login/\"><i class=\"sign in icon\"></i>ENTRAR</a></li>";
						setcookie("f_m_l", null, time()-3600, "/");
					}
				} else {
                	echo "<li><a href=\"/usuario/cadastro/\"><i class=\"menu-yellow\"><i class=\"user icon\"></i>CADASTRAR</i></a></li>";
                	echo "<li><a href=\"/usuario/login/\"><i class=\"sign in icon\"></i>ENTRAR</a></li>";
					setcookie("f_m_l", null, time()-3600, "/");
				}
        	} else {
                echo "<li><a href=\"/usuario/cadastro/\"><i class=\"menu-yellow\"><i class=\"user icon\"></i>CADASTRAR</i></a></li>";
                echo "<li><a href=\"/usuario/login/\"><i class=\"sign in icon\"></i>ENTRAR</a></li>";
            }
			
			ob_end_flush();
        }
    }
?>