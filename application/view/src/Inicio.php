<?php
namespace application\view\src;
	
	use application\view\src\include_page\menu\Pesquisa as View_Pesquisa;
			
    class Inicio {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/Inicio.php';
        }
        
        public static function Incluir_Menu_Pesquisa() {
        	new View_Pesquisa();
        }
    }
?>