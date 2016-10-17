<?php
namespace application\controller;
	
	require_once RAIZ.'/application/view/src/mapa_do_site.php';
	
	use application\view\src\Mapa_Do_Site as View_Mapa_Do_Site;
	
	@session_start();
	
    class Mapa_Do_Site {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Mapa_Do_Site();
        	
        	$view->Executar();
        }
    }
?>