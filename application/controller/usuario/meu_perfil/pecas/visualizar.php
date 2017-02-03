<?php
namespace application\controller\usuario\meu_perfil\pecas;

	require_once RAIZ.'/application/view/src/usuario/meu_perfil/pecas/visualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	require_once RAIZ.'/application/controller/include_page/menu/pesquisa.php';
	require_once RAIZ.'/application/model/dao/peca.php';
	
	use application\view\src\usuario\meu_perfil\pecas\Visualizar as View_Visualizar;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	use application\controller\include_page\menu\Pesquisa as Controller_Pesquisa;
	use application\model\dao\Peca as DAO_Peca;

    class Visualizar {

        function __construct() {
            
        }
        
        private $pagina;
        private $paginas;
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $ano_de;
        private $ano_ate;
        private $peca;
        
        public function set_categoria($categoria) : void {
        	$this->categoria = $categoria;
        }
        
        public function set_marca($marca) : void {
        	$this->marca = $marca;
        }
        
        public function set_modelo($modelo) : void {
        	$this->modelo = $modelo;
        }
        
        public function set_versao($versao) : void {
        	$this->versao = $versao;
        }
        
        public function set_ano_de($ano_de) : void {
        	$this->ano_de = $ano_de;
        }
        
        public function set_ano_ate($ano_ate) : void {
        	$this->ano_ate = $ano_ate;
        }
        
        public function set_peca($peca) : void {
        	$this->peca = $peca;
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			if (Controller_Pesquisa::Validar_Variaveis_De_Parametro($this->categoria, $this->marca, $this->modelo, $this->versao, $this->ano_de, $this->ano_ate, $this->peca)) {
	        			$view = new View_Visualizar($status);
	        			
	        			$view->set_pecas($this->Buscar_Pecas_Usuario());
	        			$view->set_pagina($this->pagina);
	        			$view->set_paginas($this->paginas);
	        			
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
        
        private function Buscar_Pecas_Usuario() : array {
        	$this->pagina = 1;
        	$this->paginas = DAO_Peca::Buscar_Numero_Paginas_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id());
        	
        	if (!empty($_GET['pagina']) AND filter_var($_GET['pagina'], FILTER_VALIDATE_INT)) {
        		if ($_GET['pagina'] > 0 AND $_GET['pagina'] <= $this->paginas) {
        			$this->pagina = $_GET['pagina'];
        		}
        	}
        	
        	return DAO_Peca::Buscar_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id(), $this->pagina);
        }
    }
?>