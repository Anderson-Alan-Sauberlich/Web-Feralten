<?php
namespace application\controller\include_page\header;

    //require_once RAIZ.'/application/controller/usuario/login.php';

    use application\controller\usuario\Login;

    class Cabecalho {

        function __construct() {
            
        }
		
		public static function Verificar_Cookie(array $login) : bool {
			return Login::Autenticar_Usuario_Cookie($login['usuario'], $login['token']);
		}
    }
?>