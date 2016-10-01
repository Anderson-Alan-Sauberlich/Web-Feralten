<?php
namespace application\view\src\publicidade;
	
	@session_start();
	
    class Dicas {

        function __construct() {
        	require_once RAIZ.'/application/view/html/publicidade/dicas.php';
        }
    }
?>