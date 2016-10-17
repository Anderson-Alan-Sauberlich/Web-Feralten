<?php
namespace application\controller;
	
	require_once RAIZ.'/application/view/src/pesquisa_avancada.php';
	
	use application\view\src\Pesquisa_Avancada as View_Pesquisa_Avancada;
	
	@session_start();
	
    class Pesquisa_Avancada {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Pesquisa_Avancada();
        	
        	$view->Executar();
        }
    }
?>