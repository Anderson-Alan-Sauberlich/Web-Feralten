<?php
namespace application\view\src\layout;
	
    //use application\controller\layout\Card_Peca as View_Card_Peca;
	use application\model\object\Peca as Object_Peca;
		
	class Card_Peca {
		
		function __construct() {
			
		}
		
		public function Executar(Object_Peca $peca) : void {
			include RAIZ.'/application/view/html/layout/Card_Peca.php';
		}
	}
?>