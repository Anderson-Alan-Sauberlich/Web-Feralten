<?php
namespace application\controller\pecas;
	
	use application\view\src\pecas\Mais_Visualizados as View_Mais_Visualizados;
	
    class Mais_Visualizados {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Mais_Visualizados();
        	
        	$view->Executar();
        }
    }
?>