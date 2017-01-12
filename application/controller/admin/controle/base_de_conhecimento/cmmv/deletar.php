<?php
namespace application\controller\admin\controle\base_de_conhecimento\cmmv;
	
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/deletar.php';
	
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\Deletar as View_Deletar;
	
    class Deletar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Deletar();
        	
        	$view->Executar();
        }
    }
?>