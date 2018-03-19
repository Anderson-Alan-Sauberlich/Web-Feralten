<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Dicas_De_Venda as View_Dicas_De_Venda;
    
    class Dicas_De_Venda
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Dicas_De_Venda();
            
            $view->Executar();
        }
    }
