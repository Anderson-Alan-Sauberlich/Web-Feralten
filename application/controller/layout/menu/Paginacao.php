<?php
namespace application\controller\layout\menu;
	
    use application\view\src\layout\menu\Paginacao as View_Paginacao;
    
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