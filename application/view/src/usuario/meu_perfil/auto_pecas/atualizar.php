<?php
namespace application\view\src\usuario\meu_perfil\auto_pecas;
    
	require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/atualizar.php');
	require_once(RAIZ.'/application/view/src/include_page/menu_usuario.php');

	use application\controller\usuario\meu_perfil\auto_pecas\Atualizar as Controller_Atualizar;
	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
	
    @session_start();

    class Atualizar {

        function __construct() {
            require_once(RAIZ.'/application/view/html/usuario/meu_perfil/auto_pecas/atualizar.php');
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario();
        }
    }
?>