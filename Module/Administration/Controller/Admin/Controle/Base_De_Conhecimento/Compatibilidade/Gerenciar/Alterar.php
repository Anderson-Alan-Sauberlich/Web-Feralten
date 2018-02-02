<?php
namespace Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar;
    
    use Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar\Alterar as View_Alterar;
    
    class Alterar
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Alterar();
            
            $view->Executar();
        }
    }
