<?php
namespace application\controller\publicidade;
	
	use application\view\src\publicidade\Dicas as View_Dicas;
	
    class Dicas {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Dicas();
        	
        	$view->Executar();
        }
    }
?>