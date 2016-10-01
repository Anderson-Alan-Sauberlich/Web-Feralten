<?php
namespace application\controller\usuario\meu_perfil\financeiro;
	
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/financeiro/boleto_atual.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
	
	use application\view\src\usuario\meu_perfil\financeiro\Boleto_Atual as View_Boleto_Atual;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
	@session_start();
		
    class Boleto_Atual {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status != 0) {
        			new View_Boleto_Atual($status);
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>