<?php
namespace application\controller\publicidade;
	
	use application\view\src\publicidade\Condicoes_Gerais as View_Condicoes_Gerais;
	
    class Condicoes_Gerais {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Condicoes_Gerais();
        	
        	$view->Executar();
        }
    }
?>