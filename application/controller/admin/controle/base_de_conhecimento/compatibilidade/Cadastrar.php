<?php
namespace application\controller\admin\controle\base_de_conhecimento\compatibilidade;
	
	use application\view\src\admin\controle\base_de_conhecimento\compatibilidade\Cadastrar as View_Cadastrar;
	
    class Cadastrar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Cadastrar();
        	
        	$view->Executar();
        }
    }
?>