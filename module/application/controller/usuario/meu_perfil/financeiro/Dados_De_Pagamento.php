<?php
namespace module\application\controller\usuario\meu_perfil\financeiro;
	
    use module\application\view\src\usuario\meu_perfil\financeiro\Dados_De_Pagamento as View_Dados_De_Pagamento;
	use module\application\controller\layout\menu\Usuario as Controller_Usuario;
	
	class Dados_De_Pagamento {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status != 0) {
        		    $view = new View_Dados_De_Pagamento($status);
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>