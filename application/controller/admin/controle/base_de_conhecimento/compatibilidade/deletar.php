<?php
namespace application\controller\admin\controle\base_de_conhecimento\compatibilidade;
	
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/compatibilidade/deletar.php';
	
	use application\view\src\admin\controle\base_de_conhecimento\compatibilidade\Deletar as View_Deletar;
	
    class Deletar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Deletar();
        	
        	$view->Executar();
        }
    }
?>