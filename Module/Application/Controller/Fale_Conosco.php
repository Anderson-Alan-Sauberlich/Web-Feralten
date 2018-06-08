<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Fale_Conosco as View_Fale_Conosco;
    use Module\Application\Controller\Layout\Form\Contato as Controller_Contato;
    
    class Fale_Conosco
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Fale_Conosco();
            
            $controller_contato = new Controller_Contato();
            
            $view->set_view_contato($controller_contato->Retornar_Pagina());
            
            $view->Executar();
        }
    }
