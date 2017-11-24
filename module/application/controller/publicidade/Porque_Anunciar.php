<?php
namespace module\application\controller\publicidade;
	
	use module\application\view\src\publicidade\Porque_Anunciar as View_Porque_Anunciar;
	
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
