<?php
namespace application\controller\dicas_de_venda;
	
	use application\view\src\dicas_de_venda\Apresentacao as View_Apresentacao;
	
    class Apresentacao {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Apresentacao();
        	
        	$view->Executar();
        }
    }
?>