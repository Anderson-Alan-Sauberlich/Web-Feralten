<?php
namespace application\controller\publicidade;
	
	require_once RAIZ.'/application/view/src/publicidade/porque_anunciar.php';
	
	use application\view\src\publicidade\Porque_Anunciar as View_Porque_Anunciar;
	
    class Porque_Anunciar {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	$view = new View_Porque_Anunciar();
        	
        	$view->Executar();
        }
    }
?>