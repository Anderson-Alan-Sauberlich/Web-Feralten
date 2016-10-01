<?php
namespace application\view\src;
	
	@session_start();
	
    class Documentacao {

        function __construct() {
        	require_once RAIZ.'/application/view/html/documentacao.php';
        }
    }
?>