<?php
namespace application\controller\usuario\meu_perfil\financeiro;
	
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/financeiro/meu_plano.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
	
	use application\view\src\usuario\meu_perfil\financeiro\Meu_Plano as View_Meu_Plano;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
	@session_start();
	
    class Meu_Plano {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status != 0) {
        			new View_Meu_Plano($status);
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>