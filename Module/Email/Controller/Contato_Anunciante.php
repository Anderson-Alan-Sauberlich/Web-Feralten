<?php
namespace Module\Email\Controller;
    
    use Module\Email\View\SRC\Contato_Anunciante as View_Contato_Anunciante;
    
    class Contato_Anunciante
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Email()
        {
            $view = new View_Contato_Anunciante();
            
            $view->Executar();
        }
    }
