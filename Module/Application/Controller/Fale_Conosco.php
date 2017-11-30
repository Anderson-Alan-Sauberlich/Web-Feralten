<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Fale_Conosco as View_Fale_Conosco;
    
    class Fale_Conosco
    {
        
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Fale_Conosco();
            
            $view->Executar();
        }
    }
