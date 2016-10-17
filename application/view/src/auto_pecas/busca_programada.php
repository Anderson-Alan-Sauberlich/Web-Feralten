<?php
namespace application\view\src\auto_pecas;

	@session_start();

    class Busca_Programada {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/auto_pecas/busca_programada.php';
        }
    }
?>