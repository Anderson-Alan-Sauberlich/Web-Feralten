<?php
namespace Module\Email\Controller;
    
    use Module\Email\View\SRC\Mensagem as View_Mensagem;
    
    class Mensagem
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Email()
        {
            $view = new View_Mensagem();
            
            $view->Executar();
        }
    }
