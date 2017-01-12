<?php
namespace application\controller\admin\controle\base_de_conhecimento\compatibilidade;
	
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/compatibilidade/atualizar.php';
	
	use application\view\src\admin\controle\base_de_conhecimento\compatibilidade\Atualizar as View_Atualizar;
	
    class Atualizar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Atualizar();
        	
        	$view->Executar();
        }
    }
?>