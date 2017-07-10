<?php
namespace application\controller;
	
    use application\view\src\Fale_Conosco as View_Fale_Conosco;
	
    class Fale_Conosco {
        
        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
            $view = new View_Fale_Conosco();
        	
        	$view->Executar();
        }
    }
?>