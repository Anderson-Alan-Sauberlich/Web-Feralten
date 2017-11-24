<?php
namespace module\application\controller\dicas_de_venda;
	
	use module\application\view\src\dicas_de_venda\Venda_Segura as View_Venda_Segura;
	
    class Venda_Segura
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	$view = new View_Venda_Segura();
        	
        	$view->Executar();
        }
    }
