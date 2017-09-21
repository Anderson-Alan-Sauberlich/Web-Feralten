<?php
namespace module\application\controller\admin\controle\base_de_conhecimento\compatibilidade\gerenciar;
	
    use module\application\view\src\admin\controle\base_de_conhecimento\compatibilidade\gerenciar\Deletar as View_Deletar;
	
    class Deletar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Deletar();
        	
        	$view->Executar();
        }
    }
?>