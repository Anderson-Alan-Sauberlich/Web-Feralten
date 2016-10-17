<?php
namespace application\controller\usuario\meu_perfil;

	require_once RAIZ.'/application/view/src/usuario/meu_perfil/perfil.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';

	use application\view\src\usuario\meu_perfil\Perfil as View_Perfil;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
	@session_start();
	
    class Perfil {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		$view = new View_Perfil($status);
        		
        		$view->Executar();
        	} else {
        		return false;
        	}
        }
    }
?>