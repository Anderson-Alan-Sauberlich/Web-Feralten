<?php
namespace application\controller;
	
	use application\view\src\Pagina_Inicial as View_Pagina_Inicial;
	
    class Pagina_Inicial {
		
        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Pagina_Inicial();
        	
        	$view->Executar();
        }
    }
?>