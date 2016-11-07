<?php
namespace application\controller;
	
	require_once RAIZ.'/application/view/src/quem_somos.php';
	
	use application\view\src\Quem_Somos as View_Quem_Somos;
		
    class Quem_Somos {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Quem_Somos();
        	
        	$view->Executar();
        }
    }
?>