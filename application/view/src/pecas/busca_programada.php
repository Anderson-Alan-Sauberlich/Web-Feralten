<?php
namespace application\view\src\pecas;

	@session_start();

    class Busca_Programada {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/pecas/busca_programada.php';
        }
    }
?>