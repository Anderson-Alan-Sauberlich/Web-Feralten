<?php
namespace Module\Application\Controller\Layout\Modal;
    
    use Module\Application\View\SRC\Layout\Modal\Saindo as View_Saindo;
                                  
    class Saindo
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina() : void
        {
            $view = new View_Saindo();
            
            $view->Executar();
        }
    }
