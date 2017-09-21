<?php
namespace module\application\controller\layout\header;

    use module\application\controller\usuario\Login;

    class Cabecalho {

        function __construct() {
            
        }
		
		public static function Verificar_Cookie(array $login) : bool {
			return Login::Autenticar_Usuario_Cookie($login['usuario'], $login['token']);
		}
    }
?>