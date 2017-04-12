<?php
namespace application\view\src\usuario\meu_perfil;
    
	require_once RAIZ.'/application/view/src/include_page/menu/usuario.php';
	
	use application\view\src\include_page\menu\Usuario as View_Usuario;
	
    class Perfil {

        function __construct(int $status) {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/perfil.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Usuario(self::$status_usuario, array('meu-perfil', null));
        }
    }
?>