<?php
namespace application\controller\usuario\meu_perfil\financeiro;
	
	use application\view\src\usuario\meu_perfil\financeiro\Boleto_Atual as View_Boleto_Atual;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	
    class Boleto_Atual {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status != 0) {
        			$view = new View_Boleto_Atual($status);
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>