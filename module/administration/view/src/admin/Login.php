<?php
namespace module\administration\view\src\admin;

	class Login {
	
		function __construct() {
			
		}
		
		private static $login_admin_erros;
		
		public function set_login_admin_erros(?array $login_admin_erros = null) : void {
			self::$login_admin_erros = $login_admin_erros;
		}
		
		public function Executar() : void {
			require_once RAIZ.'/module/administration/view/html/admin/Login.php';
		}
		
		public static function Mostrar_Erros() : void {
			$login_admin_erros = null;
			 
			if (!empty(self::$login_admin_erros)) {
				$login_admin_erros = self::$login_admin_erros;
			} else if (!empty($_SESSION['login_admin_erros'])) {
				$login_admin_erros = $_SESSION['login_admin_erros'];
				unset($_SESSION['login_admin_erros']);
			}
			 
			if (!empty($login_admin_erros)) {
				foreach ($login_admin_erros as $value) {
					echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
				}
			}
		}
	}
?>