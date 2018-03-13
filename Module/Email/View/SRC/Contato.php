<?php
namespace Module\Email\View\SRC;
    
    class Contato
    {
        function __construct()
        {
            
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Email/View/HTML/Contato.php';
        }
    }
