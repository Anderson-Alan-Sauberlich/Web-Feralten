<?php
namespace application\view\src\usuario\meu_perfil;
    
	require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
	
	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
	
    class Perfil {

        function __construct($status) {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/perfil.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('meu-perfil', null));
        }
    }
?>