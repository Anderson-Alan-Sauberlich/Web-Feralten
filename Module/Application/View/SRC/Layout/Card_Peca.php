<?php
namespace Module\Application\View\SRC\Layout;
	
    //use Module\Application\Controller\Layout\Card_Peca as View_Card_Peca;
	use Module\Application\Model\Object\Peca as Object_Peca;
		
	class Card_Peca
	{
		
		function __construct()
		{
			
		}
		
		public function Executar(Object_Peca $peca) : void
		{
			include RAIZ.'/Module/Application/View/HTML/Layout/Card_Peca.php';
		}
	}
