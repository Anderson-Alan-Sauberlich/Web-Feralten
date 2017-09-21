<?php
namespace module\application\view\src;
	
    use module\application\view\src\layout\menu\Pesquisa as View_Pesquisa;
	
    class Inicio {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/module/application/view/html/Inicio.php';
        }
        
        public static function Incluir_Menu_Pesquisa() {
        	new View_Pesquisa();
        }
    }
?>