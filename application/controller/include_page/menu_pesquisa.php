<?php
namespace application\controller\include_page;

	require_once RAIZ.'/application/model/dao/categoria.php';
	require_once RAIZ.'/application/model/dao/marca.php';
	require_once RAIZ.'/application/model/dao/modelo.php';
	require_once RAIZ.'/application/model/dao/versao.php';
	require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php';

	use application\model\dao\Categoria as DAO_Categoria;
	use application\model\dao\Marca as DAO_Marca;
	use application\model\dao\Modelo as DAO_Modelo;
	use application\model\dao\Versao as DAO_Versao;
	use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa;
	
    class Menu_Pesquisa {

        function __construct() {
            
        }
        
        public function Retornar_Marcas_Por_Categoria() {
        	View_Menu_Pesquisa::Carregar_Marcas($_GET['categoria']);
        }
        
        public function Retornar_Modelos_Por_Marca() {
        	View_Menu_Pesquisa::Carregar_Modelos($_GET['marca']);
        }
        
        public function Retornar_Versoes_Por_Modelo() {
        	View_Menu_Pesquisa::Carregar_Versoes($_GET['modelo']);
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
        
        public static function Buscar_Versoes_Por_Id_Modelo($modelo) {
        	if (!empty($modelo)) {
        		return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
        	} else {
        		return null;
        	}
        }
        
        public static function Validar_Variaveis_De_Parametro($categoria, $marca, $modelo, $versao, $ano_de, $ano_ate, $peca) {
        	$categoria = strip_tags($categoria);
        	$marca = strip_tags($marca);
        	$modelo = strip_tags($modelo);
        	$versao = strip_tags($versao);
        	$ano_de = strip_tags($ano_de);
        	$ano_ate = strip_tags($ano_ate);
        	$peca = strip_tags($peca);
        	 
        	$categoria = trim($categoria);
        	$marca = trim($marca);
        	$modelo = trim($modelo);
        	$versao = trim($versao);
        	$ano_de = trim($ano_de);
        	$ano_ate = trim($ano_ate);
        	$peca = trim($peca);
        	
        	
        	
        	return true;
        }
    }
?>