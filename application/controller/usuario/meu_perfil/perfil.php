<?php
namespace application\controller\usuario\meu_perfil;

	require_once RAIZ.'/application/view/src/usuario/meu_perfil/perfil.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';

	use application\view\src\usuario\meu_perfil\Perfil as View_Perfil;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	
    class Perfil {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		$view = new View_Perfil($status);
        		
        		$view->Executar();
        	} else {
        		return false;
        	}
        }
    }
?>