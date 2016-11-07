<?php
namespace application\controller\dicas_de_venda;
	
	require_once RAIZ.'/application/view/src/dicas_de_venda/principais.php';
	
	use application\view\src\dicas_de_venda\Principais as View_Principais;
	
    class Principais {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Principais();
        	
        	$view->Executar();
        }
    }
?>