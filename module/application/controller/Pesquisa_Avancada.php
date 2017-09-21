<?php
namespace module\application\controller;
	
	use module\application\view\src\Pesquisa_Avancada as View_Pesquisa_Avancada;
	
    class Pesquisa_Avancada {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Pesquisa_Avancada();
        	
        	$view->Executar();
        }
    }
?>