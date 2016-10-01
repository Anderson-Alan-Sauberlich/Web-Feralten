<?php
namespace application\view\src\auto_pecas;

	require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php';

	use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa;
	
	@session_start();

    class Mais_Visualizados {

        function __construct() {
        	require_once RAIZ.'/application/view/html/auto_pecas/mais_visualizados.php';
        }
        
        public static function Incluir_Menu_Pesquisa() {
        	new View_Menu_Pesquisa();
        }
    }
?>