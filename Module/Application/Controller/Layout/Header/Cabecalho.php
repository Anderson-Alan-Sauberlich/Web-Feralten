<?php
namespace Module\Application\Controller\Layout\Header;

    use Module\Application\Controller\Usuario\Login;

    class Cabecalho
    {

        function __construct()
        {
            
        }
		
		public static function Verificar_Cookie(array $login) : bool
		{
			return Login::Autenticar_Usuario_Cookie($login['usuario'], $login['token']);
		}
    }
