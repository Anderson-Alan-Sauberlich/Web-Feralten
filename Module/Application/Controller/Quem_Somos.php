<?php
namespace Module\Application\Controller;
	
	use Module\Application\View\SRC\Quem_Somos as View_Quem_Somos;
	
    class Quem_Somos
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	$view = new View_Quem_Somos();
        	
        	$view->Executar();
        }
    }
