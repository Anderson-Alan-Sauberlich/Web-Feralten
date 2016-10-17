<?php
namespace application\view\src\auto_pecas;

	@session_start();

    class Resultados {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/auto_pecas/resultados.php';
        }
    }
?>