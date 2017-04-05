<?php
namespace application\controller\include_page\menu;

	require_once RAIZ.'/application/view/src/include_page/menu/filtro.php';
	require_once RAIZ.'/application/model/dao/cidade.php';
	require_once RAIZ.'/application/model/dao/estado.php';
	require_once RAIZ.'/application/model/dao/status_peca.php';
	
	use application\view\src\include_page\menu\Filtro as View_Filtro;
	use application\model\dao\Cidade as DAO_Cidade;
	use application\model\dao\Estado as DAO_Estado;
	use application\model\dao\Status_Peca as DAO_Status_Peca;

	class Filtro {
		
	    function __construct() {
	        
		}
		
		public function Retornar_Cidades_Por_Estado() : void {
			if (isset($_GET['estado'])) {
				View_Filtro::Mostrar_Cidades($_GET['estado']);
			}
		}
		
		public static function Buscar_Estados() {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidade_Por_Estado(int $id_estado) {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
		
		public static function Buscar_Status_Pecas() {
			return DAO_Status_Peca::BuscarTodos();
		}
	}
?>