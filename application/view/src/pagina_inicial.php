<?php
namespace application\view\src;

    class Pagina_Inicial {

        function __construct() {
        	
        }
        
        public static function Carregar_Pagina_HTML() {
        	require_once(RAIZ.'/application/view/html/pagina_inicial.php');
        }
    }
?>