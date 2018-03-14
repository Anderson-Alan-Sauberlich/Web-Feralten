<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Termos_De_Uso as View_Termos_De_Uso;
    
    class Termos_De_Uso
    {
        function __construct()
        {
            
        }
        
        public static function Carregar_Pagina()
        {
            $view = new View_Termos_De_Uso();
            
            $view->Executar();
        }
    }
