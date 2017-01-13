<?php
namespace application\view\src\admin\controle\base_de_conhecimento\cmmv;

	class Cadastrar {
	
		function __construct() {
			
		}
		
		private static $categorias;
		
		public function set_categorias($categorias) {
			self::$categorias = $categorias;
		}
		
		public function Executar() {
			require_once RAIZ.'/application/view/html/admin/controle/base_de_conhecimento/cmmv/cadastrar.php';
		}
		
		public static function Carregar_Categorias() {
			echo "<option value=\"0\">Categoria</option>";
			
			if (!empty(self::$categorias) AND self::$categorias !== false) {
				foreach (self::$categorias as $categoria) {
					echo "<option value=\"".$categoria->get_id()."\">".$categoria->get_nome()."</option>";
				}
			} else {
				echo "<option value=\"\">Erro</option>";
			}
		}
		
		public static function Carregar_Marcas($marcas = null) {
			echo "<option value=\"0\">Marca</option>";
		
			if (!empty($marcas) AND $marcas !== false) {
				foreach ($marcas as $marca) {
					echo "<option value=\"".$marca->get_id()."\">".$marca->get_nome()."</option>";
				}
			} else {
				echo "<option value=\"\">Erro</option>";
			}
		}
		
		public static function Carregar_Modelos($modelos = null) {
			echo "<option value=\"0\">Modelo</option>";
		
			if (!empty($modelos) AND $modelos !== false) {
				foreach ($modelos as $modelo) {
					echo "<option value=\"".$modelo->get_id()."\">".$modelo->get_nome()."</option>";
				}
			} else {
				echo "<option value=\"\">Erro</option>";
			}
		}
		
		public static function Carregar_Versoes($versoes = null) {
			echo "<option value=\"0\">Versão</option>";
		
			if (!empty($versoes) AND $versoes !== false) {
				foreach ($versoes as $versao) {
					echo "<option value=\"".$versao->get_id()."\">".$versao->get_nome()."</option>";
				}
			} else {
				echo "<option value=\"\">Erro</option>";
			}
		}
	}
?>