<?php
namespace application\view\src\include_page;

	@session_start();
	
	class Menu_Paginacao {
		
		function __construct($pagina, $paginas) {
			self::$pagina = $pagina;
			self::$paginas = $paginas;
			
			if (self::$paginas > 1) {
				require_once RAIZ.'/application/view/html/include_page/menu_paginacao.php';
			}
		}
		
		private static $pagina;
		private static $paginas;
		
		public static function Mostrar_Indices_Paginas() {
			$inicio = 1;
			$fim = self::$paginas;
			
			if (self::$paginas > 9) {
				if (self::$pagina > 5) {
					$inicio = self::$pagina - 4;
					$fim = self::$pagina + 4;
				} else {
					$fim = 9;
				}
			}
			
			for ($i = $inicio; $i <= $fim; $i++) {
				if (self::$pagina == $i) {
					echo "<a class=\"active red item\">$i</a>";
				} else {
					echo "<a class=\"item\" href=\"/usuario/meu-perfil/pecas/visualizar/?p=$i\">$i</a>";
				}
			}
		}
		
		public static function Mostrar_Item_Anterior() {
			if (self::$pagina != 1) {
				echo "<a class=\"item\" href=\"/usuario/meu-perfil/pecas/visualizar/?p=".(self::$pagina - 1)."\"><i class=\"chevron left icon\"></i></a>";
			} else {
				echo "<a class=\"disabled item\"><i class=\"chevron left icon\"></i></a>";
			}
		}
		
		public static function Mostrar_Item_Proximo() {
			if (self::$pagina != self::$paginas) {
				echo "<a class=\"item\" href=\"/usuario/meu-perfil/pecas/visualizar/?p=".(self::$pagina + 1)."\"><i class=\"chevron right icon\"></i></a>";
			} else {
				echo "<a class=\"disabled item\"><i class=\"chevron right icon\"></i></a>";
			}
		}
	}
?>