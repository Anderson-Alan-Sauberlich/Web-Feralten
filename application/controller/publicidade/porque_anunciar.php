<?php
namespace application\controller\publicidade;
	
	require_once RAIZ.'/application/view/src/publicidade/porque_anunciar.php';
	
	use application\view\src\publicidade\Porque_Anunciar as View_Porque_Anunciar;
	
	@session_start();
	
    class Porque_Anunciar {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Porque_Anunciar();
        }
    }
?>