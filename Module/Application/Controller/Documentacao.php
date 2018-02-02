<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Documentacao as View_Documentacao;
    
    class Documentacao
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Documentacao();
            
            $view->Executar();
        }
    }
