<?php
namespace application\controller\pecas;
	
	require_once RAIZ.'/application/view/src/pecas/resultados.php';
	
	use application\view\src\pecas\Resultados as View_Resultados;
	
    class Resultados {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Resultados();
        	
        	$view->Executar();
        }
    }
?>