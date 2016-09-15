<?php
namespace application\view\src\include_page;

    require_once(RAIZ.'/application/model/object/categoria.php');
    require_once(RAIZ.'/application/model/object/marca.php');
    require_once(RAIZ.'/application/model/object/modelo.php');
    require_once(RAIZ.'/application/controller/include_page/menu.php');
    
    use application\model\object\Categoria as Object_Categoria;
    use application\model\object\Marca as Object_Marca;
    use application\model\object\Modelo as Object_Modelo;
    use application\controller\include_page\Menu as Controller_Menu;
    
    @session_start();

    class Menu {

        function __construct() {
        	require_once(RAIZ.'/application/view/html/include_page/menu.php');
        	
        	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        		if (isset($_GET['categoria'])) {
        			self::Carregar_Marcas($_GET['categoria']);
        		}
        		if (isset($_GET['marca'])) {
        			self::Carregar_Modelos($_GET['marca']);
        		}
        	} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['pesquisa'])) {
                    
                }
            }
        }
        
        public static function Carregar_Anos() {
            for ($i=2017; $i >= 1800; $i--) {
                echo "<option value=\"".$i."\">".$i."</option>";
            }
        }
        
        public static function Carregar_Categorias() {
            $categorias = Controller_Menu::Buscar_Todas_Categorias();
            echo "<option value=\"0\">Categoria</option>";
            foreach ($categorias as $categoria) {
                echo "<option value=\"".$categoria->get_id()."\">".$categoria->get_nome()."</option>";
            }
        }
        
        public static function Carregar_Marcas($categoria) {            
            $marcas = Controller_Menu::Buscar_Marca_Por_Id_Categoria($categoria);
            echo "<option value=\"0\">Marca</option>";
            foreach ($marcas as $marca) {
                echo "<option value=\"".$marca->get_id()."\">".$marca->get_nome()."</option>";
            }
        }
        
        public static function Carregar_Modelos($marca) {
            $modelos = Controller_Menu::Buscar_Modelo_Por_Id_Marca($marca);
            echo "<option value=\"0\">Modelo</option>";
            foreach ($modelos as $modelo) {
                echo "<option value=\"".$modelo->get_id()."\">".$modelo->get_nome()."</option>";
            }
        }
    }
?>