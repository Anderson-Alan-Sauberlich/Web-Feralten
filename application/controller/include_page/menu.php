<?php
namespace application\controller\include_page;

	require_once(RAIZ.'/application/model/dao/dao_categoria.php');
	require_once(RAIZ.'/application/model/dao/dao_marca.php');
	require_once(RAIZ.'/application/model/dao/dao_modelo.php');

	use application\model\dao\DAO_Categoria;
	use application\model\dao\DAO_Marca;
	use application\model\dao\DAO_Modelo;
	
    class Menu {

        function __construct() {
            
        }
        
        public static function Buscar_Todas_Categorias() {
        	return DAO_Categoria::BuscarTodos();
        }
        
        public static function Buscar_Marca_Por_Id_Categoria($categoria) {
        	return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
        }
        
        public static function Buscar_Modelo_Por_Id_Marca($marca) {
        	return DAO_Modelo::Buscar_Por_ID_Marca($marca);
        }
    }
?>