<?php
namespace module\application\view\src\layout\mensagens;
	
    use module\application\controller\layout\mensagens\Cadastro_Incompleto as Controller_Cadastro_Incompleto;
    
    class Cadastro_Incompleto {
		
        function __construct() {
            
        }
		
        public static function Mostrar_Nome() : void {
            echo Controller_Cadastro_Incompleto::Mostrar_Nome();
        }
    }
?>