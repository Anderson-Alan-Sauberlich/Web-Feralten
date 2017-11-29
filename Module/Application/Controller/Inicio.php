<?php
namespace Module\Application\Controller;
	
	use Module\Application\View\SRC\Inicio as View_Inicio;
	
    class Inicio
    {
		
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	$view = new View_Inicio();
        	
        	$view->Executar();
        }
    }
