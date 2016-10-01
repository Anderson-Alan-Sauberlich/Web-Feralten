<?php
namespace application\view\src;
	
	@session_start();
	
    class Pesquisa_Avancada {

        function __construct() {
        	require_once RAIZ.'/application/view/html/pesquisa_avancada.php';
        }
    }
?>