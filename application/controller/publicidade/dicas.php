<?php
namespace application\controller\publicidade;
	
	require_once RAIZ.'/application/view/src/publicidade/dicas.php';
	
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