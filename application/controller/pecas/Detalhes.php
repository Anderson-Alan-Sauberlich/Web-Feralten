<?php
namespace application\controller\pecas;
	
	use application\view\src\pecas\Detalhes as View_Detalhes;
	
    class Detalhes {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Detalhes();
        	
        	$view->Executar();
        }
    }
?>