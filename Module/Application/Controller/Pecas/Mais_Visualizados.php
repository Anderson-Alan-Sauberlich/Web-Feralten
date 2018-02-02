<?php
namespace Module\Application\Controller\Pecas;
    
    use Module\Application\View\SRC\Pecas\Mais_Visualizados as View_Mais_Visualizados;
    
    class Mais_Visualizados
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Mais_Visualizados();
            
            $view->Executar();
        }
    }
