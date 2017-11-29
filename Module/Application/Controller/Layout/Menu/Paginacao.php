<?php
namespace Module\Application\Controller\Layout\Menu;
	
    use Module\Application\View\SRC\Layout\Menu\Paginacao as View_Paginacao;
    
    class Paginacao
    {
		
        function __construct()
        {
            
        }
        
        public static function get_pagina()
        {
        	if (isset($_GET['pagina'])) {
        		return $_GET['pagina'];
        	}
        }
    }
