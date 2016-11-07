<?php
namespace application\view\src\pecas;
	
	@session_start();

    class Mais_Visualizados {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/pecas/mais_visualizados.php';
        }
    }
?>