<?php
namespace application\controller\dicas_de_venda;
	
	require_once RAIZ.'/application/view/src/dicas_de_venda/venda_segura.php';
	
	use application\view\src\dicas_de_venda\Venda_Segura as View_Venda_Segura;
	
	@session_start();
	
    class Venda_Segura {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Venda_Segura();
        }
    }
?>