<?php
namespace application\view\src;
	
	@session_start();
	
    class Mapa_Do_Site {

        function __construct() {
        	require_once RAIZ.'/application/view/html/mapa_do_site.php';
        }
    }
?>