<?php
namespace Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar;
    
    use Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar\Deletar as View_Deletar;
    
    class Deletar
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Deletar();
            
            $view->Executar();
        }
    }
