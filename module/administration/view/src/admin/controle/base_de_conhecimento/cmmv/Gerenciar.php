<?php
namespace module\administration\view\src\admin\controle\base_de_conhecimento\cmmv;
    
    use module\administration\controller\admin\controle\base_de_conhecimento\cmmv\Gerenciar as Controller_Gerenciar;
    use module\administration\view\src\layout\menu\Admin as View_Admin;
    
    class Gerenciar {
        
        function __construct() {
            
        }
        
        public function Executar() : void {
            require_once RAIZ.'/module/administration/view/html/admin/controle/base_de_conhecimento/cmmv/Gerenciar.php';
        }
        
        public static function Incluir_Menu_Admin() : void {
            new View_Admin();
        }
        
        public static function Incluir_Pagina_Cadastrar() : void {
            Controller_Gerenciar::Carregar_Pagina_Cadastrar();
        }
        
        public static function Incluir_Pagina_Alterar() : void {
            Controller_Gerenciar::Carregar_Pagina_Alterar();
        }
        
        public static function Incluir_Pagina_Deletar() : void {
            Controller_Gerenciar::Carregar_Pagina_Deletar();
        }
    }
?>