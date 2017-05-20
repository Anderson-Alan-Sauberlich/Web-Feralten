<?php
namespace application\controller\usuario\meu_perfil\pecas;
	
	require_once RAIZ.'/application/model/common/util/login_session.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/pecas/visualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	require_once RAIZ.'/application/controller/include_page/menu/pesquisa.php';
	
	use application\model\common\util\Login_Session;
	use application\view\src\usuario\meu_perfil\pecas\Visualizar as View_Visualizar;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	use application\controller\include_page\menu\Pesquisa as Controller_Pesquisa;
				
    class Visualizar {

        function __construct() {
        	$this->controller_pesquisa = new Controller_Pesquisa();
        }
        
        private $erros_visualizar = array();
        private $controller_pesquisa;
        
        public function set_pagina($pagina) : void {
        	$this->controller_pesquisa->set_pagina($pagina);
        }
        
        public function set_categoria_url($url_categoria) : void {
        	$this->controller_pesquisa->set_categoria_url($url_categoria);
        }
        
        public function set_marca_url($url_marca) : void {
        	$this->controller_pesquisa->set_marca_url($url_marca);
        }
        
        public function set_modelo_url($url_modelo) : void {
        	$this->controller_pesquisa->set_modelo_url($url_modelo);
        }
        
        public function set_versao_url($url_versao) : void {
        	$this->controller_pesquisa->set_versao_url($url_versao);
        }
        
        public function set_ano_de($ano_de) : void {
        	$this->controller_pesquisa->set_ano_de($ano_de);
        }
        
        public function set_ano_ate($ano_ate) : void {
        	$this->controller_pesquisa->set_ano_ate($ano_ate);
        }
        
        public function set_peca_nome($nome_peca) : void {
        	$this->controller_pesquisa->set_peca_nome($nome_peca);
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			if (empty($this->erros_visualizar)) {
        				$this->controller_pesquisa->set_peca_usuario(Login_Session::get_entidade_id());
        				
	        			$view = new View_Visualizar($status);
	        			
	        			$view->set_pecas($this->controller_pesquisa->Buscar_Pecas());
	        			$view->set_pagina($this->controller_pesquisa->get_pagina());
	        			$view->set_paginas($this->controller_pesquisa->get_paginas());
	        			
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