<?php
namespace application\view\src;

	require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php';

	use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa;
			
    class Pagina_Inicial {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/pagina_inicial.php';
        }
        
        public static function Incluir_Menu_Pesquisa() {
        	new View_Menu_Pesquisa();
        }
    }
?>