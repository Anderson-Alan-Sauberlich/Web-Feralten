<?php
namespace application\view\src\usuario\meu_perfil\financeiro;
    
    use application\view\src\layout\menu\Usuario as View_Usuario;
    
    class Boletos_Pagos {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/financeiro/Boletos_Pagos.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Usuario(self::$status_usuario, array('financeiro', 'boletos-pagos'));
        }
    }
?>