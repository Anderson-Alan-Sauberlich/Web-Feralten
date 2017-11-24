<?php
namespace module\application\view\src\layout;
	
    //use module\application\controller\layout\Card_Peca as View_Card_Peca;
	use module\application\model\object\Peca as Object_Peca;
		
	class Card_Peca
	{
		
		function __construct()
		{
			
		}
		
		public function Executar(Object_Peca $peca) : void
		{
			include RAIZ.'/module/application/view/html/layout/Card_Peca.php';
		}
	}
