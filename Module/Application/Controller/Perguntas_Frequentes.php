<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Perguntas_Frequentes as View_Perguntas_Frequentes;
    use Module\Application\Controller\Layout\Form\Contato as Controller_Contato;
    
    class Perguntas_Frequentes
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Perguntas_Frequentes();
            
            $controller_contato = new Controller_Contato();
            
            $view->set_view_contato($controller_contato->Retornar_Pagina());
            
            $view->Executar();
        }
    }
