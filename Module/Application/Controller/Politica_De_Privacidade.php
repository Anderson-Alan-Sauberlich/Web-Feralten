<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Politica_De_Privacidade as View_Politica_De_Privacidade;
    
    class Politica_De_Privacidade
    {
        function __construct()
        {
            
        }
        
        public static function Carregar_Pagina()
        {
            $view = new View_Politica_De_Privacidade();
            
            $view->Executar();
        }
    }
