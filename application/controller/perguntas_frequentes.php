<?php
namespace application\controller;
	
	require_once RAIZ.'/application/view/src/perguntas_frequentes.php';
	
	use application\view\src\Perguntas_Frequentes as View_Perguntas_Frequentes;
	
	@session_start();
	
    class Perguntas_Frequentes {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Perguntas_Frequentes();
        	
        	$view->Executar();
        }
    }
?>