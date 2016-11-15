<?php
namespace application\controller;
	
	require_once RAIZ.'/application/view/src/contato.php';
	
	use application\view\src\Contato as View_Contato;
	
    class Contato {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Contato();
        	
        	$view->Executar();
        }
    }
?>