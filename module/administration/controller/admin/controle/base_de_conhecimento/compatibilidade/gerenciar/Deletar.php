<?php
namespace module\administration\controller\admin\controle\base_de_conhecimento\compatibilidade\gerenciar;
	
    use module\administration\view\src\admin\controle\base_de_conhecimento\compatibilidade\gerenciar\Deletar as View_Deletar;
	
    class Deletar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Deletar();
        	
        	$view->Executar();
        }
    }
?>