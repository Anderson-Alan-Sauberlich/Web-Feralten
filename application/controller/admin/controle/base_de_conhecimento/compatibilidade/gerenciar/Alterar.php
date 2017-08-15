<?php
namespace application\controller\admin\controle\base_de_conhecimento\compatibilidade\gerenciar;
	
	use application\view\src\admin\controle\base_de_conhecimento\compatibilidade\gerenciar\Alterar as View_Alterar;
	
    class Alterar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Alterar();
        	
        	$view->Executar();
        }
    }
?>