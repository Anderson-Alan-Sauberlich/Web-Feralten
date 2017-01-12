<?php
namespace application\controller\admin\controle\base_de_conhecimento\cmmv;
	
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/cadastrar.php';
	
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\Cadastrar as View_Cadastrar;
	
    class Cadastrar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Cadastrar();
        	
        	$view->Executar();
        }
    }
?>