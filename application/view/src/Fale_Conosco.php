<?php
namespace application\view\src;
    
    use application\view\src\include_page\form\Contato as View_Contato;
    
    class Fale_Conosco {
        
        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/Fale_Conosco.php';
        }
        
        public static function Incluir_Form_Contato() : void {
            new View_Contato();
        }
    }
?>