<?php
namespace Module\Email\Controller;
    
    use Module\Email\View\SRC\Boas_Vindas as View_Boas_Vindas;
    
    class Boas_Vindas
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Email()
        {
            $view = new View_Boas_Vindas();
            
            $view->Executar();
        }
    }
