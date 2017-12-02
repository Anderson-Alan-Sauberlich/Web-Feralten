<?php
namespace Module\Application\View\SRC\Layout;
    
    use Module\Application\Controller\Layout\Loader as Controller_Loader;
    
    class Loader
    {
        
        function __construct()
        {
            
        }
        
        public function Executar() : void
        {
            if (!Controller_Loader::Validar_IP()) {
                include RAIZ.'/Module/Application/View/HTML/Layout/Loader.php';
            }
        }
    }
