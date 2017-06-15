<?php
namespace application\controller\include_page\menu;
	
	use application\view\src\include_page\menu\Paginacao as View_Paginacao;

    class Paginacao {
		
        function __construct() {
            
        }
        
        public static function get_pagina() {
        	if (isset($_GET['pagina'])) {
        		return $_GET['pagina'];
        	}
        }
    }
?>