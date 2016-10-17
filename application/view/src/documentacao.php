<?php
namespace application\view\src;
	
	@session_start();
	
    class Documentacao {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/documentacao.php';
        }
    }
?>