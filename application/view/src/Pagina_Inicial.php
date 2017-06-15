<?php
namespace application\view\src;
	
	use application\view\src\include_page\menu\Pesquisa as View_Pesquisa;
			
    class Pagina_Inicial {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/Pagina_Inicial.php';
        }
        
        public static function Incluir_Menu_Pesquisa() {
        	new View_Pesquisa();
        }
    }
?>