<?php
namespace Module\Application\View\SRC\Layout\Mensagens;
    
    use Module\Application\Controller\Layout\Mensagens\Cadastro_Incompleto as Controller_Cadastro_Incompleto;
    
    class Cadastro_Incompleto
    {
        
        function __construct()
        {
            
        }
        
        public static function Mostrar_Nome() : void
        {
            echo Controller_Cadastro_Incompleto::Mostrar_Nome();
        }
    }
