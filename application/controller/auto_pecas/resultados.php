<?php
namespace application\controller\auto_pecas;
	
	require_once RAIZ.'/application/view/src/auto_pecas/resultados.php';
	
	use application\view\src\auto_pecas\Resultados as View_Resultados;
	
	@session_start();
	
    class Resultados {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Resultados();
        }
    }
?>