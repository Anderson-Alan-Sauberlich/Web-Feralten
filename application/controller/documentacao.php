<?php
namespace application\controller;
	
	require_once RAIZ.'/application/view/src/documentacao.php';
	
	use application\view\src\Documentacao as View_Documentacao;
	
    class Documentacao {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Documentacao();
        	
        	$view->Executar();
        }
    }
?>