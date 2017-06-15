<?php
namespace application\view\src\include_page;
	
	//use application\controller\include_page\Card_Peca as View_Card_Peca;
	use application\model\object\Peca as Object_Peca;
		
	class Card_Peca {
		
		function __construct() {
			
		}
		
		public function Executar(Object_Peca $peca) : void {
			include RAIZ.'/application/view/html/include_page/Card_Peca.php';
		}
	}
?>