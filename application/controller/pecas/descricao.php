<?php
namespace application\controller\pecas;
	
	require_once RAIZ.'/application/view/src/pecas/descricao.php';
	
	use application\view\src\pecas\Descricao as View_Descricao;
	
	@session_start();
	
    class Descricao {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Descricao();
        	
        	$view->Executar();
        }
    }
?>