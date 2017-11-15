<?php
namespace module\application\controller\usuario\meu_perfil\financeiro;
	
	use module\application\view\src\usuario\meu_perfil\financeiro\Meu_Plano as View_Meu_Plano;
	use module\application\controller\layout\menu\Usuario as Controller_Usuario;
	use module\application\model\dao\Plano as DAO_Plano;
	use module\application\model\common\util\Login_Session;
	
    class Meu_Plano {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status != 0) {
        		    $view = new View_Meu_Plano($status, DAO_Plano::BuscarTodos(), Login_Session::get_entidade_plano());
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>