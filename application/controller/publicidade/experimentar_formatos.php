<?php
namespace application\controller\publicidade;
	
	require_once RAIZ.'/application/view/src/publicidade/experimentar_formatos.php';
	
	use application\view\src\publicidade\Experimentar_Formatos as View_Experimentar_Formatos;
	
    class Experimentar_Formatos {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Experimentar_Formatos();
        	
        	$view->Executar();
        }
    }
?>