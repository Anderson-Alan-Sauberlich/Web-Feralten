<?php
namespace application\controller;
	
	use application\view\src\Perguntas_Frequentes as View_Perguntas_Frequentes;
	
    class Perguntas_Frequentes {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Perguntas_Frequentes();
        	
        	$view->Executar();
        }
    }
?>