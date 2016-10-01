<?php
namespace application\controller\usuario\meu_perfil\pacotes;
	
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/pacotes/adicionar.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
	
	use application\view\src\usuario\meu_perfil\pacotes\Adicionar as View_Adicionar;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
	@session_start();
	
    class Adicionar {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        
        		if ($status != 0) {
        			new View_Adicionar($status);
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>