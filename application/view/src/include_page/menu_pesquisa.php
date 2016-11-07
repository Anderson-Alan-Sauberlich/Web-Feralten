<?php
namespace application\view\src\include_page;

    require_once RAIZ.'/application/controller/include_page/menu_pesquisa.php';
    
    use application\controller\include_page\Menu_Pesquisa as Controller_Menu_Pesquisa;
    
    class Menu_Pesquisa {

        function __construct() {
        	require_once RAIZ.'/application/view/html/include_page/menu_pesquisa.php';
        }
        
        public static function Carregar_Anos() {
            for ($i=2017; $i >= 1900; $i--) {
                echo "<option value=\"".$i."\">".$i."</option>";
            }
        }
        
        public static function Carregar_Categorias() {
            $categorias = Controller_Menu_Pesquisa::Buscar_Todas_Categorias();
            
            echo "<option value=\"0\">Categoria</option>";
            
            if (!empty($categorias) AND $categorias !== false) {
	            foreach ($categorias as $categoria) {
	                echo "<option value=\"".$categoria->get_id()."\">".$categoria->get_nome()."</option>";
	            }
            } else {
            	echo "<option value=\"\">Erro</option>";
            }
        }
        
        public static function Carregar_Marcas($categoria = null) {
            $marcas = Controller_Menu_Pesquisa::Buscar_Marca_Por_Id_Categoria($categoria);
            
            echo "<option value=\"0\">Marca</option>";
            
            if (!empty($marcas) AND $marcas !== false) {
	            foreach ($marcas as $marca) {
	                echo "<option value=\"".$marca->get_id()."\">".$marca->get_nome()."</option>";
	            }
            } else {
            	echo "<option value=\"\">Erro</option>";
            }
        }
        
        public static function Carregar_Modelos($marca = null) {
            $modelos = Controller_Menu_Pesquisa::Buscar_Modelo_Por_Id_Marca($marca);
            
            echo "<option value=\"0\">Modelo</option>";
            
            if (!empty($modelos) AND $modelos !== false) {
	            foreach ($modelos as $modelo) {
	                echo "<option value=\"".$modelo->get_id()."\">".$modelo->get_nome()."</option>";
	            }
            } else {
            	echo "<option value=\"\">Erro</option>";
            }
        }
    }
?>