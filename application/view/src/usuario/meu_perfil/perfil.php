<?php
namespace application\view\src\usuario\meu_perfil;
    
	require_once(RAIZ.'/application/controller/usuario/meu_perfil/perfil.php');
	require_once(RAIZ.'/application/view/src/include_page/menu_usuario.php');
	
	use application\controller\usuario\meu_perfil\Perfil as Controller_Perfil;
	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
	
    @session_start();

    class Perfil {

        function __construct() {
            require_once(RAIZ.'/application/view/html/usuario/meu_perfil/perfil.php');
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario();
        }
    }
?>