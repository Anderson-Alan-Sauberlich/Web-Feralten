<?php
namespace module\application\controller;
	
	use module\application\view\src\Documentacao as View_Documentacao;
	
    class Documentacao
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	$view = new View_Documentacao();
        	
        	$view->Executar();
        }
    }
