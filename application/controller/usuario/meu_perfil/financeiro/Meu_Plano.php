<?php
namespace application\controller\usuario\meu_perfil\financeiro;
	
	use application\view\src\usuario\meu_perfil\financeiro\Meu_Plano as View_Meu_Plano;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	
    class Meu_Plano {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status != 0) {
        			$view = new View_Meu_Plano($status);
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>