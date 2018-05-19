<?php
namespace Module\Email\View\SRC;
    
    class Mensagem
    {
        function __construct()
        {
            
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Email/View/HTML/Mensagem.php';
        }
    }
