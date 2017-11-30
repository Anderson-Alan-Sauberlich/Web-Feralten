<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\View\SRC\Layout\Menu\Pesquisa as View_Pesquisa;
    
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
    }
