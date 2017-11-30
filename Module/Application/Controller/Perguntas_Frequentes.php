<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Perguntas_Frequentes as View_Perguntas_Frequentes;
    
    class Perguntas_Frequentes
    {
        
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Perguntas_Frequentes();
            
            $view->Executar();
        }
    }
