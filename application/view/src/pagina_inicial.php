<?php
namespace application\view\src;

	require_once(RAIZ.'/application/view/src/include_page/menu.php');

	use application\view\src\include_page\Menu;
			
    class Pagina_Inicial extends Menu {

        function __construct() {
        	require_once(RAIZ.'/application/view/html/pagina_inicial.php');
        }
    }
?>