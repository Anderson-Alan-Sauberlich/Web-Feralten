<?php
namespace application\view\src;
	
    use application\view\src\layout\form\Contato as View_Contato;
    
    class Perguntas_Frequentes {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/Perguntas_Frequentes.php';
        }
        
        public static function Incluir_Form_Contato() : void {
            new View_Contato();
        }
    }
?>