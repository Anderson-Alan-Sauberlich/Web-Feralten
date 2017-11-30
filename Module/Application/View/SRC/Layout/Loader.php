<?php
namespace Module\Application\View\SRC\Layout;
    
    //use Module\Application\Controller\Layout\Loader as View_Loader;
    
    class Loader
    {
        
        function __construct()
        {
            
        }
        
        public function Executar() : void
        {
            include RAIZ.'/Module/Application/View/HTML/Layout/Loader.php';
        }
    }
