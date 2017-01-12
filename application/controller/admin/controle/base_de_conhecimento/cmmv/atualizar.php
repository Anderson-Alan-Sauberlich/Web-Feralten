<?php
namespace application\controller\admin\controle\base_de_conhecimento\cmmv;
	
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/atualizar.php';
	
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\Atualizar as View_Atualizar;
	
    class Atualizar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Atualizar();
        	
        	$view->Executar();
        }
    }
?>