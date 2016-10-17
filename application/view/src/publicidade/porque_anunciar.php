<?php
namespace application\view\src\publicidade;
	
	@session_start();
	
    class Porque_Anunciar {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/publicidade/porque_anunciar.php';
        }
    }
?>