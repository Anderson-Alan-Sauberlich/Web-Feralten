<?php
namespace application\controller\admin\controle\base_de_conhecimento\cmmv;
	
	require_once RAIZ.'/application/model/dao/categoria.php';
	require_once RAIZ.'/application/model/dao/marca.php';
	require_once RAIZ.'/application/model/dao/modelo.php';
	require_once RAIZ.'/application/model/dao/versao.php';
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/cadastrar.php';
	
	use application\model\dao\Categoria as DAO_Categoria;
	use application\model\dao\Marca as DAO_Marca;
	use application\model\dao\Modelo as DAO_Modelo;
	use application\model\dao\Versao as DAO_Versao;
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\Cadastrar as View_Cadastrar;
	
    class Cadastrar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Cadastrar();
        	
        	$view->set_categorias(DAO_Categoria::BuscarTodos());
        	
        	$view->Executar();
        }
        
        public function Retornar_Marcas_Por_Categoria() {
        	View_Cadastrar::Carregar_Marcas(self::Buscar_Marca_Por_Id_Categoria($_GET['categoria']));
        }
        
        public function Retornar_Modelos_Por_Marca() {
        	View_Cadastrar::Carregar_Modelos(self::Buscar_Modelo_Por_Id_Marca($_GET['marca']));
        }
        
        public function Retornar_Versoes_Por_Modelo() {
        	View_Cadastrar::Carregar_Versoes(self::Buscar_Versoes_Por_Id_Modelo($_GET['modelo']));
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
    }
?>