<?php
namespace application\view\src;
	
	@session_start();
	
    class Perguntas_Frequentes {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/perguntas_frequentes.php';
        }
    }
?>