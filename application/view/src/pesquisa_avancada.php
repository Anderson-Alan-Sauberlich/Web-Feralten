<?php
namespace application\view\src;
	
	@session_start();
	
    class Pesquisa_Avancada {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/pesquisa_avancada.php';
        }
    }
?>