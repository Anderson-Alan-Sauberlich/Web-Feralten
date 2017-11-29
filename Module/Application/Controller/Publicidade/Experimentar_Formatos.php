<?php
namespace Module\Application\Controller\Publicidade;
	
	use Module\Application\View\SRC\Publicidade\Experimentar_Formatos as View_Experimentar_Formatos;
	
    class Experimentar_Formatos
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	$view = new View_Experimentar_Formatos();
        	
        	$view->Executar();
        }
    }
