<?php
namespace Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar;
    
    use Module\Administration\View\SRC\Layout\Menu\Admin as View_Admin;
    
    class Cadastrar
    {
    
        function __construct()
        {
            
        }
        
        private static $categorias;
        
        public function set_categorias(array $categorias) : void
        {
            self::$categorias = $categorias;
        }
        
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Administration/View/HTML/Admin/Controle/Base_De_Conhecimento/CMMV/Gerenciar/Cadastrar.php';
        }
        
        public static function Incluir_Menu_Admin() : void
        {
            new View_Admin();
        }
        
        public static function Carregar_Categorias(?array $categorias = null) : void
        {
            echo "<option value=\"0\">Categoria</option>";
            
            if (!empty($categorias) AND $categorias !== null) {
                self::$categorias = $categorias;
            }
            
            if (!empty(self::$categorias) AND self::$categorias !== false) {
                foreach (self::$categorias as $categoria) {
                    echo "<option value=\"".$categoria->get_id()."\">".$categoria->get_nome()."</option>";
                }
            } else {
                echo "<option value=\"\">Erro</option>";
            }
        }
        
        public static function Carregar_Marcas(?array $marcas = null) : void
        {
            echo "<option value=\"0\">Marca</option>";
        
            if (!empty($marcas) AND $marcas !== false) {
                foreach ($marcas as $marca) {
                    echo "<option value=\"".$marca->get_id()."\">".$marca->get_nome()."</option>";
                }
            } else {
                echo "<option value=\"\">Erro</option>";
            }
        }
        
        public static function Carregar_Modelos(?array $modelos = null) : void
        {
            echo "<option value=\"0\">Modelo</option>";
        
            if (!empty($modelos) AND $modelos !== false) {
                foreach ($modelos as $modelo) {
                    echo "<option value=\"".$modelo->get_id()."\">".$modelo->get_nome()."</option>";
                }
            } else {
                echo "<option value=\"\">Erro</option>";
            }
        }
        
        public static function Carregar_Versoes(?array $versoes = null) : void
        {
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
