<?php
namespace application\controller\dicas_de_venda;
	
	require_once RAIZ.'/application/view/src/dicas_de_venda/principais.php';
	
	use application\view\src\dicas_de_venda\Principais as View_Principais;
	
	@session_start();
	
    class Principais {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Principais();
        }
    }
?>