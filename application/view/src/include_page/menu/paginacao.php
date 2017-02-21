<?php
namespace application\view\src\include_page\menu;

	class Paginacao {
		
		function __construct($pagina, $paginas) {
			self::$pagina = $pagina;
			self::$paginas = $paginas;
			
			if (self::$paginas > 1) {
				require_once RAIZ.'/application/view/html/include_page/menu/paginacao.php';
			}
		}
		
		private static $pagina;
		private static $paginas;
		
		public static function Mostrar_Indices_Paginas() {
			$inicio = 1;
			$fim = self::$paginas;
			
			if (self::$paginas > 6) {
				if ((self::$paginas - self::$pagina) <= 3) {
					$inicio = (self::$paginas - 6);
					$fim = self::$paginas;
				} else if (self::$pagina > 3 AND 3 < (self::$paginas - self::$pagina)) {
					$inicio = (self::$pagina - 3);
					$fim = (self::$pagina + 3);
				} else if (self::$pagina <= 3) {
					$inicio = 1;
					$fim = 7;
				}
			}
			
			for ($i = $inicio; $i <= $fim; $i++) {
				if (self::$pagina == $i) {
					echo "<a class=\"active red item\">$i</a>";
				} else {
					if (empty($_GET) AND strripos($_SERVER['REQUEST_URI'], '/?') === false) {
						echo "<a class=\"item\" href=\"".$_SERVER['REQUEST_URI']."?pagina=$i"."\">$i</a>";
					} else if (!empty($_GET['pagina'])) {
						$get_pagina = $_GET['pagina'];
						$uri = str_replace("pagina=$get_pagina", "pagina=$i", $_SERVER['REQUEST_URI']);
						echo "<a class=\"item\" href=\"$uri\">$i</a>";
					} else if (isset($_GET['pagina'])) {
						if ($_GET['pagina'] > -1 AND $_GET['pagina'] < 1) {
							$get_pagina = $_GET['pagina'];
							$uri = str_replace("pagina=$get_pagina", "pagina=$i", $_SERVER['REQUEST_URI']);
							echo "<a class=\"item\" href=\"$uri\">$i</a>";
						} else if (strripos($_SERVER['REQUEST_URI'], 'pagina=') !== false) {
							$uri = str_replace("pagina=", "pagina=$i", $_SERVER['REQUEST_URI']);
							echo "<a class=\"item\" href=\"$uri\">$i</a>";
						} else if (strripos($_SERVER['REQUEST_URI'], 'pagina') !== false) {
							$uri = str_replace("pagina", "pagina=$i", $_SERVER['REQUEST_URI']);
							echo "<a class=\"item\" href=\"$uri\">$i</a>";
						}
					} else {
						echo "<a class=\"item\" href=\"".$_SERVER['REQUEST_URI']."&pagina=$i"."\">$i</a>";
					}
				}
			}
		}
		
		public static function Mostrar_Item_Anterior() {
			if (self::$pagina != 1) {
				$pagina_anterior = self::$pagina - 1;
				if (empty($_GET) AND strripos($_SERVER['REQUEST_URI'], '/?') === false) {
					echo "<a class=\"item\" href=\"".$_SERVER['REQUEST_URI']."?pagina=$pagina_anterior"."\"><i class=\"chevron left icon\"></i></a>";
				} else if (!empty($_GET['pagina'])) {
					$get_pagina = $_GET['pagina'];
					$uri = str_replace("pagina=$get_pagina", "pagina=$pagina_anterior", $_SERVER['REQUEST_URI']);
					echo "<a class=\"item\" href=\"$uri\"><i class=\"chevron left icon\"></i></a>";
				} else if (isset($_GET['pagina'])) {
					if ($_GET['pagina'] > -1 AND $_GET['pagina'] < 1) {
						$get_pagina = $_GET['pagina'];
						$uri = str_replace("pagina=$get_pagina", "pagina=$pagina_anterior", $_SERVER['REQUEST_URI']);
						echo "<a class=\"item\" href=\"$uri\"><i class=\"chevron left icon\"></i></a>";
					} else if (strripos($_SERVER['REQUEST_URI'], 'pagina=') !== false) {
						$uri = str_replace("pagina=", "pagina=$pagina_anterior", $_SERVER['REQUEST_URI']);
						echo "<a class=\"item\" href=\"$uri\"><i class=\"chevron left icon\"></i></a>";
					} else if (strripos($_SERVER['REQUEST_URI'], 'pagina') !== false) {
						$uri = str_replace("pagina", "pagina=$pagina_anterior", $_SERVER['REQUEST_URI']);
						echo "<a class=\"item\" href=\"$uri\"><i class=\"chevron left icon\"></i></a>";
					}
				} else {
					echo "<a class=\"item\" href=\"".$_SERVER['REQUEST_URI']."&pagina=$pagina_anterior"."\"><i class=\"chevron left icon\"></i></a>";
				}
			} else {
				echo "<a class=\"disabled item\"><i class=\"chevron left icon\"></i></a>";
			}
		}
		
		public static function Mostrar_Item_Proximo() {
			if (self::$pagina != self::$paginas) {
				$pagina_seguinte = self::$pagina + 1;
				if (empty($_GET) AND strripos($_SERVER['REQUEST_URI'], '/?') === false) {
					echo "<a class=\"item\" href=\"".$_SERVER['REQUEST_URI']."?pagina=$pagina_seguinte"."\"><i class=\"chevron right icon\"></i></a>";
				} else if (!empty($_GET['pagina'])) {
					$get_pagina = $_GET['pagina'];
					$uri = str_replace("pagina=$get_pagina", "pagina=$pagina_seguinte", $_SERVER['REQUEST_URI']);
					echo "<a class=\"item\" href=\"$uri\"><i class=\"chevron right icon\"></i></a>";
				} else if (isset($_GET['pagina'])) {
					if ($_GET['pagina'] > -1 AND $_GET['pagina'] < 1) {
						$get_pagina = $_GET['pagina'];
						$uri = str_replace("pagina=$get_pagina", "pagina=$pagina_seguinte", $_SERVER['REQUEST_URI']);
						echo "<a class=\"item\" href=\"$uri\"><i class=\"chevron right icon\"></i></a>";
					} else if (strripos($_SERVER['REQUEST_URI'], 'pagina=') !== false) {
						$uri = str_replace("pagina=", "pagina=$pagina_seguinte", $_SERVER['REQUEST_URI']);
						echo "<a class=\"item\" href=\"$uri\"><i class=\"chevron right icon\"></i></a>";
					} else if (strripos($_SERVER['REQUEST_URI'], 'pagina') !== false) {
						$uri = str_replace("pagina", "pagina=$pagina_seguinte", $_SERVER['REQUEST_URI']);
						echo "<a class=\"item\" href=\"$uri\"><i class=\"chevron right icon\"></i></a>";
					}
				} else {
					echo "<a class=\"item\" href=\"".$_SERVER['REQUEST_URI']."&pagina=$pagina_seguinte"."\"><i class=\"chevron right icon\"></i></a>";
				}
			} else {
				echo "<a class=\"disabled item\"><i class=\"chevron right icon\"></i></a>";
			}
		}
	}
?>