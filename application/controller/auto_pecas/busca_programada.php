<?php
namespace application\controller\auto_pecas;
	
	require_once RAIZ.'/application/view/src/auto_pecas/busca_programada.php';
	
	use application\view\src\auto_pecas\Busca_Programada as View_Busca_Programada;
	
	@session_start();
	
    class Busca_Programada {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Busca_Programada();
        	
        	$view->Executar();
        }
    }
?>