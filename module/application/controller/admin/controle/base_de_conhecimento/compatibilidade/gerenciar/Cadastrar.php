<?php
namespace module\application\controller\admin\controle\base_de_conhecimento\compatibilidade\gerenciar;
	
    use module\application\view\src\admin\controle\base_de_conhecimento\compatibilidade\gerenciar\Cadastrar as View_Cadastrar;
	
    class Cadastrar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Cadastrar();
        	
        	$view->Executar();
        }
    }
?>