<?php
namespace module\application\view\src\usuario\meu_perfil\financeiro;
    
    use module\application\view\src\layout\menu\Usuario as View_Usuario;
    use module\application\view\src\layout\Cards_Planos as View_Cards_Planos;
    
    class Meu_Plano {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar() {
        	require_once RAIZ.'/module/application/view/html/usuario/meu_perfil/financeiro/Meu_Plano.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Usuario(self::$status_usuario, array('financeiro', 'meu-plano'));
        }
        
        public static function Incluir_Cards_planos() {
            new View_Cards_Planos();
        }
    }
?>