<?php
namespace application\controller;

	require_once RAIZ.'/application/view/src/pagina_inicial.php';

	use application\view\src\Pagina_Inicial as View_Pagina_Inicial;

	@session_start();
	
    class Pagina_Inicial {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Pagina_Inicial();
        	
        	$view->Executar();
        }
    }
?>