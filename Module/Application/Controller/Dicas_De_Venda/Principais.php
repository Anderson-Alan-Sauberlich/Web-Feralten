<?php
namespace Module\Application\Controller\Dicas_De_Venda;
    
    use Module\Application\View\SRC\Dicas_De_Venda\Principais as View_Principais;
    
    class Principais
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Principais();
            
            $view->Executar();
        }
    }
