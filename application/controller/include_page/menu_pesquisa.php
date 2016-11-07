<?php
namespace application\controller\include_page;

	require_once RAIZ.'/application/model/dao/categoria.php';
	require_once RAIZ.'/application/model/dao/marca.php';
	require_once RAIZ.'/application/model/dao/modelo.php';
	require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php';

	use application\model\dao\Categoria as DAO_Categoria;
	use application\model\dao\Marca as DAO_Marca;
	use application\model\dao\Modelo as DAO_Modelo;
	use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa;
	
    class Menu_Pesquisa {

        function __construct() {
            
        }
        
        public static function Retornar_Marcas_Por_Categoria() {
        	View_Menu_Pesquisa::Carregar_Marcas($_GET['categoria']);
        }
        
        public static function Retornar_Modelos_Por_Marca() {
        	View_Menu_Pesquisa::Carregar_Modelos($_GET['marca']);
        }
        
        public static function Buscar_Todas_Categorias() {
        	return DAO_Categoria::BuscarTodos();
        }
        
        public static function Buscar_Marca_Por_Id_Categoria($categoria) {
        	if (!empty($categoria)) {
        		return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
        	} else {
        		return null;
        	}
        }
        
        public static function Buscar_Modelo_Por_Id_Marca($marca) {
        	if (!empty($marca)) {
        		return DAO_Modelo::Buscar_Por_ID_Marca($marca);
        	} else {
        		return null;
        	}
        }
    }
?>