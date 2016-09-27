<?php
namespace application\controller\include_page;

    require_once(RAIZ.'/application/controller/usuario/login.php');

    use application\controller\usuario\Login;

    @session_start();

    class Cabecalho {

        function __construct() {
            
        }
		
		public static function Verificar_Cookie($login) {
			return Login::Autenticar_Usuario_Cookie($login['usuario'], $login['token']);
		}
    }
?>