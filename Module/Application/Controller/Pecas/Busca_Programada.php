<?php
namespace Module\Application\Controller\Pecas;
	
	use Module\Application\View\SRC\Pecas\Busca_Programada as View_Busca_Programada;
	
    class Busca_Programada
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	$view = new View_Busca_Programada();
        	
        	$view->Executar();
        }
    }
