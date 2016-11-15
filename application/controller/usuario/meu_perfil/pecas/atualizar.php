<?php
namespace application\controller\usuario\meu_perfil\pecas;
    
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/pecas/atualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';

	use application\view\src\usuario\meu_perfil\pecas\Atualizar as View_Atualizar;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
    class Atualizar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			$view = new View_Atualizar($status);
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>