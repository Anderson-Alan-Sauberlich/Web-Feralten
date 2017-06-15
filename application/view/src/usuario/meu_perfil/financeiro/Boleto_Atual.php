<?php
namespace application\view\src\usuario\meu_perfil\financeiro;
    
	use application\view\src\include_page\menu\Usuario as View_Usuario;
	
    class Boleto_Atual {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/financeiro/Boleto_Atual.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Usuario(self::$status_usuario, array('financeiro', 'boleto-atual'));
        }
    }
?>