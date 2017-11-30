<?php
namespace Module\Application\Controller\Dicas_De_Venda;
    
    use Module\Application\View\SRC\Dicas_De_Venda\Apresentacao as View_Apresentacao;
    
    class Apresentacao
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Apresentacao();
            
            $view->Executar();
        }
    }
