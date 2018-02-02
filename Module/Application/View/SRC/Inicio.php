<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\View\SRC\Layout\Menu\Pesquisa as View_Pesquisa;
    use Module\Application\View\SRC\Layout\Loader as View_Loader;
    
    class Inicio
    {
        function __construct()
        {
            
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Inicio.php';
        }
        
        public static function Incluir_Menu_Pesquisa()
        {
            new View_Pesquisa();
        }
        
        public static function Carregar_Loader() : void
        {
            $view_loader = new View_Loader();
            
            $view_loader->Executar();
        }
    }
