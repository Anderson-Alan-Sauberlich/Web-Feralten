<?php
namespace application\controller\include_page;

	require_once RAIZ.'/application/view/src/include_page/menu_filtro.php';
	require_once RAIZ.'/application/model/dao/cidade.php';
	require_once RAIZ.'/application/model/dao/estado.php';
	require_once RAIZ.'/application/model/dao/status_peca.php';
	
	use application\view\src\include_page\Menu_Filtro as View_Menu_Filtro;
	use application\model\dao\Cidade as DAO_Cidade;
	use application\model\dao\Estado as DAO_Estado;
	use application\model\dao\Status_Peca as DAO_Status_Peca;

	class Menu_Filtro {
		
	    function __construct() {
	        
		}
		
		public static function Retornar_Cidades_Por_Estado() {
			if (isset($_GET['estado'])) {
				View_Menu_Filtro::Mostrar_Cidades($_GET['estado']);
			}
		}
		
		public static function Buscar_Estados() {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidade_Por_Estado($id_estado) {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
		
		public static function Buscar_Status_Pecas() {
			return DAO_Status_Peca::BuscarTodos();
		}
	}
?>