<?php
namespace Module\Application\Controller\Dicas_De_Venda;
    
    use Module\Application\View\SRC\Dicas_De_Venda\Venda_Segura as View_Venda_Segura;
    
    class Venda_Segura
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Venda_Segura();
            
            $view->Executar();
        }
    }
