<?php
namespace application\view\src;

	@session_start();

    class Contato {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/contato.php';
        }
    }
?>