<?php
namespace Module\Application\Controller\Layout\Mensagens;
    
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Cadastro_Incompleto
    {
        function __construct()
        {
            
        }
        
        /**
         * Retorna o nome do usuario logado.
         * 
         * @return string
         */
        public static function Mostrar_Nome() : string
        {
            return Login_Session::get_usuario_nome();
        }
    }
