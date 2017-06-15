<?php
namespace application\view\src\include_page\mensagens;
	
    use application\controller\include_page\mensagens\Cadastro_Incompleto as Controller_Cadastro_Incompleto;

    class Cadastro_Incompleto {
		
        function __construct() {
            
        }
		
        public static function Mostrar_Nome() : void {
            echo Controller_Cadastro_Incompleto::Mostrar_Nome();
        }
    }
?>