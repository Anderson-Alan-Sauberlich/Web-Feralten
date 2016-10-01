<?php
namespace application\controller\auto_pecas;
	
	require_once RAIZ.'/application/view/src/auto_pecas/descricao.php';
	
	use application\view\src\auto_pecas\Descricao as View_Descricao;
	
	@session_start();
	
    class Descricao {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Descricao();
        }
    }
?>