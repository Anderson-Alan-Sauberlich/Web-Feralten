<?php
namespace Module\Email\Controller;
    
    use Module\Email\View\SRC\Contato as View_Contato;
    
    class Contato
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Email()
        {
            $view = new View_Contato();
            
            $view->Executar();
        }
    }
