<?php
namespace Module\Email\Controller;
    
    use Module\Email\View\SRC\Orcamento_Peca as View_Orcamento_Peca;
    
    class Orcamento_Peca
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Email()
        {
            $view = new View_Orcamento_Peca();
            
            $view->Executar();
        }
    }
