<?php
namespace Module\Application\View\SRC\Layout\Header;
	
    use Module\Application\Controller\Layout\Header\Cabecalho as Controller_Cabecalho;
    
    class Cabecalho
    {

        function __construct()
        {
			
        }
        
        public static function Verificar_Usuario_Autenticado() : void
        {
        	if (isset($_SESSION['login'])) {
        		echo "<li><a href=\"/usuario/meu-perfil/\"><i class=\"menu-yellow\"><i class=\"user icon\"></i>MEU PERFIL</i></a></li>";
				echo "<li><a href=\"/usuario/login/sair/?logout=".hash_hmac('sha1', session_id(), sha1(session_id()))."\"><i class=\"sign out icon\"></i>SAIR</a></li>";
        	} else if (isset($_COOKIE['f_m_l'])) {
        		$login = unserialize($_COOKIE['f_m_l']);
				
				if (isset($login['usuario']) AND isset($login['token'])) {
					if (Controller_Cabecalho::Verificar_Cookie($login)) {
        				echo "<li><a href=\"/usuario/meu-perfil/\"><i class=\"menu-yellow\"><i class=\"user icon\"></i>MEU PERFIL</i></a></li>";
						echo "<li><a href=\"/usuario/login/sair/?logout=".hash_hmac('sha1', session_id(), sha1(session_id()))."\"><i class=\"sign out icon\"></i>SAIR</a></li>";
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
        }
    }
