<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Mapa_Do_Site as View_Mapa_Do_Site;
    
    class Mapa_Do_Site
    {
        function __construct()
        {
            
        }
        
        public static function Carregar_Pagina()
        {
            $view = new View_Mapa_Do_Site();
            
            $view->Executar();
        }
    }
