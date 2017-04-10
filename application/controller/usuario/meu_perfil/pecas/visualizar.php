<?php
namespace application\controller\usuario\meu_perfil\pecas;
	
	require_once RAIZ.'/application/model/util/login_session.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/pecas/visualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	require_once RAIZ.'/application/controller/include_page/menu/pesquisa.php';
	
	use application\model\util\Login_Session;
	use application\view\src\usuario\meu_perfil\pecas\Visualizar as View_Visualizar;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	use application\controller\include_page\menu\Pesquisa as Controller_Pesquisa;
				
    class Visualizar extends Controller_Pesquisa {

        function __construct() {
        	parent::__construct();
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			if ($this->Validar_Variaveis()) {
        				$this->set_peca_usuario(Login_Session::get_entidade_id());
        				
	        			$view = new View_Visualizar($status);
	        			
	        			$view->set_pecas($this->Buscar_Pecas());
	        			$view->set_pagina($this->get_pagina());
	        			$view->set_paginas($this->get_paginas());
	        			
	        			$view->Executar();
        			} else {
        				return 'erro';
        			}
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public static function Mostrar_Nome() : string {
        	return Login_Session::get_usuario_nome();
        }
    }
?>