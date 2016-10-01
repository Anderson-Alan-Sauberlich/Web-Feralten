<?php
namespace application\controller;
	
	require_once RAIZ.'/application/view/src/quem_somos.php';
	
	use application\view\src\Quem_Somos as View_Quem_Somos;
		
	@session_start();
	
    class Quem_Somos {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Quem_Somos();
        }
    }
?>