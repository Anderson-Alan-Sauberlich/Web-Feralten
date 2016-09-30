<?php
namespace application\controller\usuario\meu_perfil\auto_pecas;
    
	require_once(RAIZ.'/application/view/src/usuario/meu_perfil/auto_pecas/atualizar.php');
	require_once(RAIZ.'/application/controller/include_page/menu_usuario.php');

	use application\view\src\usuario\meu_perfil\auto_pecas\Atualizar as View_Atualizar;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
	@session_start();
	
    class Atualizar {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			new View_Atualizar($status);
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>