<?php
namespace application\controller;
	
	use application\view\src\Inicio as View_Inicio;
	
    class Inicio {
		
        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Inicio();
        	
        	$view->Executar();
        }
    }
?>