<?php
namespace application\controller\pecas;
	
	use application\view\src\pecas\Busca_Programada as View_Busca_Programada;
	
    class Busca_Programada {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Busca_Programada();
        	
        	$view->Executar();
        }
    }
?>