<?php
namespace Module\Application\Controller\Layout\Modal;
    
    use Module\Application\View\SRC\Layout\Modal\Solicitar_Orcamento as View_Solicitar_Orcamento;
    
    class Solicitar_Orcamento
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina() : void
        {
            $view = new View_Solicitar_Orcamento();
            
            $view->Executar();
        }
    }
