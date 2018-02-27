<?php
namespace Module\Application\Controller\Layout\Header;

    use Module\Application\Controller\Usuario\Login;

    class Cabecalho
    {
        function __construct()
        {
            
        }
        
        /**
         * Function chamada na view/html para verificar se um cookie esta setado para apartir deste realizar a autenticação.
         * 
         * @param array $login
         * @return bool
         */
        public static function Verificar_Cookie(array $login) : bool
        {
            return Login::Autenticar_Usuario_Cookie($login['usuario'], $login['token']);
        }
    }
