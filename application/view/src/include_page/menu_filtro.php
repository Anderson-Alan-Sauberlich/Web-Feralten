<?php
namespace application\view\src\include_page;

	require_once RAIZ.'/application/controller/include_page/menu_filtro.php';

	use application\controller\include_page\Menu_Filtro as Controller_Menu_Filtro;

	@session_start();
	
	class Menu_Filtro {
		
	    function __construct() {
	        require_once RAIZ.'/application/view/html/include_page/menu_filtro.php';
		}
		
		public static function Mostrar_Estados() {
			$estados = Controller_Menu_Filtro::Buscar_Estados();
		
			foreach ($estados as $estado) {
				echo "<option value=\"". $estado->get_id() . "\">" . $estado->get_uf() . " - " . $estado->get_nome() . "</option>";
			}
		}
		
		public static function Mostrar_Cidades($estado = null) {
			$cidades = array();
			 
			if (isset($estado)) {
				$cidades = Controller_Menu_Filtro::Buscar_Cidade_Por_Estado($estado);
			}
		
			echo "<option value=\"0\">Selecione a Cidade</option>";
				
			foreach ($cidades as $cidade) {
				echo "<option value=\"". $cidade->get_id() . "\">" . $cidade->get_nome() . "</option>";
			}
		}
		
		public static function Mostrar_Status() {
			$satus_pecas = Controller_Menu_Filtro::Buscar_Status_Pecas();
				
			foreach ($satus_pecas as $status_peca) {
				echo "<option value=\"".$status_peca->get_id()."\">".$status_peca->get_nome()."</option>";
			}
		}
	}
?>