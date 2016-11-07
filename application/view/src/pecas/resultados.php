<?php
namespace application\view\src\pecas;

	@session_start();

    class Resultados {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/pecas/resultados.php';
        }
    }
?>