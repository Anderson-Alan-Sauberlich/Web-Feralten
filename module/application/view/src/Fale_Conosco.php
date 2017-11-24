<?php
namespace module\application\view\src;
    
    use module\application\view\src\layout\form\Contato as View_Contato;
    
    class Fale_Conosco
    {
        
        function __construct()
        {
        	
        }
        
        public function Executar()
        {
        	require_once RAIZ.'/module/application/view/html/Fale_Conosco.php';
        }
        
        public static function Incluir_Form_Contato() : void
        {
            new View_Contato();
        }
    }
