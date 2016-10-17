<?php
namespace application\view\src\publicidade;
	
	@session_start();
	
    class Dicas {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/publicidade/dicas.php';
        }
    }
?>