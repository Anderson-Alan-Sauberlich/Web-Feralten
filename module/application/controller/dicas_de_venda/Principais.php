<?php
namespace module\application\controller\dicas_de_venda;
	
	use module\application\view\src\dicas_de_venda\Principais as View_Principais;
	
    class Principais {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Principais();
        	
        	$view->Executar();
        }
    }
?>