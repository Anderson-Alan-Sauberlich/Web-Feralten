<?php
namespace application\controller\pecas;
	
	require_once RAIZ.'/application/view/src/pecas/mais_visualizados.php';
	
	use application\view\src\pecas\Mais_Visualizados as View_Mais_Visualizados;
	
    class Mais_Visualizados {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Mais_Visualizados();
        	
        	$view->Executar();
        }
    }
?>