<?php
namespace Module\Application\Controller\Publicidade;
	
	use Module\Application\View\SRC\Publicidade\Porque_Anunciar as View_Porque_Anunciar;
	
    class Porque_Anunciar
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	$view = new View_Porque_Anunciar();
        	
        	$view->Executar();
        }
    }
