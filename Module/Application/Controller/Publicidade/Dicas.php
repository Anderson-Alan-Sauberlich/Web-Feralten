<?php
namespace Module\Application\Controller\Publicidade;
    
    use Module\Application\View\SRC\Publicidade\Dicas as View_Dicas;
    
    class Dicas
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Dicas();
            
            $view->Executar();
        }
    }
