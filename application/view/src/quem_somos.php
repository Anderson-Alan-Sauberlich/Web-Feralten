<?php
namespace application\view\src;
	
	@session_start();
	
    class Quem_Somos {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/quem_somos.php';
        }
    }
?>