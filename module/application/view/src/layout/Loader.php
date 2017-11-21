<?php
namespace module\application\view\src\layout;
	
    //use module\application\controller\layout\Loader as View_Loader;
	
	class Loader {
		
		function __construct() {
			
		}
		
		public function Executar() : void {
			include RAIZ.'/module/application/view/html/layout/Loader.php';
		}
	}
?>