<?php
namespace Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\Compatibilidade;
    
    use Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar as Controller_Gerenciar;
    use Module\Administration\View\SRC\Layout\Menu\Admin as View_Admin;
    
    class Gerenciar
    {
        
        function __construct()
        {
            
        }
        
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Administration/View/HTML/Admin/Controle/Base_De_Conhecimento/Compatibilidade/Gerenciar.php';
        }
        
        public static function Incluir_Menu_Admin() : void
        {
            new View_Admin();
        }
        
        public static function Incluir_Pagina_Cadastrar() : void
        {
            Controller_Gerenciar::Carregar_Pagina_Cadastrar();
        }
        
        public static function Incluir_Pagina_Alterar() : void
        {
            Controller_Gerenciar::Carregar_Pagina_Alterar();
        }
        
        public static function Incluir_Pagina_Deletar() : void
        {
            Controller_Gerenciar::Carregar_Pagina_Deletar();
        }
    }
