<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\View\SRC\Layout\Form\Contato as View_Contato;
    
    class Fale_Conosco
    {
        function __construct()
        {
            
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Fale_Conosco.php';
        }
        
        public static function Incluir_Form_Contato() : void
        {
            new View_Contato();
        }
    }
