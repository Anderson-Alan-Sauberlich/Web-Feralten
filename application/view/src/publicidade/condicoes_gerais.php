<?php
namespace application\view\src\publicidade;
	
	@session_start();
	
    class Condicoes_Gerais {

        function __construct() {
        	require_once RAIZ.'/application/view/html/publicidade/condicoes_gerais.php';
        }
    }
?>