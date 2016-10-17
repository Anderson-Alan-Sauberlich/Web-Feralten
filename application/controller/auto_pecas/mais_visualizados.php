<?php
namespace application\controller\auto_pecas;
	
	require_once RAIZ.'/application/view/src/auto_pecas/mais_visualizados.php';
	
	use application\view\src\auto_pecas\Mais_Visualizados as View_Mais_Visualizados;
	
	@session_start();
	
    class Mais_Visualizados {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Mais_Visualizados();
        	
        	$view->Executar();
        }
    }
?>