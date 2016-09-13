<?php
namespace application\controller;

	require_once(RAIZ.'/application/view/src/pagina_inicial.php');

	use application\view\src\Pagina_Inicial as View_Pagina_Inicial;

    class Pagina_Inicial {

        function __construct() {
            
        }
        
        public static function Mostrar_Pagina() {
        	View_Pagina_Inicial::Carregar_Pagina_HTML();
        }
    }
?>