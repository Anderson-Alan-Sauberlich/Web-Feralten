<?php
namespace application\view\src\usuario\meu_perfil\pecas;
    
	require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';

	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
	
    @session_start();

    class Atualizar {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/pecas/atualizar.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('pecas', 'atualizar'));
        }
    }
?>