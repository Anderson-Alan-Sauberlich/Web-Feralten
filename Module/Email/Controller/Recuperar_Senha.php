<?php
namespace Module\Email\Controller;
    
    use Module\Email\View\SRC\Recuperar_Senha as View_Recuperar_Senha;
    
    class Recuperar_Senha
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Email()
        {
            $view = new View_Recuperar_Senha();
            
            $view->Executar();
        }
    }
