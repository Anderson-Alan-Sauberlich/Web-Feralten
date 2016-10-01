<?php
namespace application\view\src;

	@session_start();

    class Contato {

        function __construct() {
        	require_once RAIZ.'/application/view/html/contato.php';
        }
    }
?>