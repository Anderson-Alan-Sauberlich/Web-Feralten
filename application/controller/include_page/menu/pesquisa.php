<?php
namespace application\controller\include_page\menu;
	
	require_once RAIZ.'/application/view/src/include_page/menu/pesquisa.php';
	require_once RAIZ.'/application/model/dao/categoria_pativel.php';
	require_once RAIZ.'/application/model/dao/marca_pativel.php';
	require_once RAIZ.'/application/model/dao/modelo_pativel.php';
	require_once RAIZ.'/application/model/dao/versao_pativel.php';
	require_once RAIZ.'/application/model/dao/categoria.php';
	require_once RAIZ.'/application/model/dao/marca.php';
	require_once RAIZ.'/application/model/dao/modelo.php';
	require_once RAIZ.'/application/model/dao/versao.php';
	require_once RAIZ.'/application/model/object/peca.php';
	require_once RAIZ.'/application/model/object/categoria_pativel.php';
	require_once RAIZ.'/application/model/object/marca_pativel.php';
	require_once RAIZ.'/application/model/object/modelo_pativel.php';
	require_once RAIZ.'/application/model/object/versao_pativel.php';
	
	use application\view\src\include_page\menu\Pesquisa as View_Pesquisa;
	use application\model\dao\Categoria_Pativel as DAO_Categoria_Pativel;
	use application\model\dao\Marca_Pativel as DAO_Marca_Pativel;
	use application\model\dao\Modelo_Pativel as DAO_Modelo_Pativel;
	use application\model\dao\Versao_Pativel as DAO_Versao_Pativel;
	use application\model\dao\Categoria as DAO_Categoria;
	use application\model\dao\Marca as DAO_Marca;
	use application\model\dao\Modelo as DAO_Modelo;
	use application\model\dao\Versao as DAO_Versao;
	use application\model\object\Peca as Object_Peca;
	use application\model\object\Categoria_Pativel as Object_Categoria_Pativel;
	use application\model\object\Marca_Pativel as Object_Marca_Pativel;
	use application\model\object\Modelo_Pativel as Object_Modelo_Pativel;
	use application\model\object\Versao_Pativel as Object_Versao_Pativel;
	
    class Pesquisa {

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
        
        public function set_usuario_id($usuario_id) : void {
        	
        }
        
        public function set_pagina($pagina) : void {
        	if (!empty($pagina)) {
        		$pagina = trim($pagina);
        		
	        	if (filter_var($pagina, FILTER_VALIDATE_INT) !== false) {
	        		$this->pagina = $pagina;
	        	}
        	}
        }
        
        public function set_paginas($paginas) {
        	if (!empty($paginas)) {
        		if (filter_var($paginas, FILTER_VALIDATE_INT) !== false) {
	        		$this->paginas = $paginas;
	        		
	        		if (empty($this->pagina) OR $this->pagina <= 0) {
	        			$this->pagina = 1;
	        		} else if ($this->pagina > $this->paginas) {
	        			$this->pagina = $this->paginas;
	        		}
        		}
        	}
        }
        
        public function set_categoria($url_categoria) : void {
        	if (!empty($url_categoria)) {
        		$url_categoria = trim($url_categoria);
        		
        		if (strip_tags($url_categoria) === $url_categoria) {
        			$retorno = DAO_Categoria::Buscar_ID_Por_URL($url_categoria);
        			
        			if (!empty($retorno) AND $retorno !== false) {
        				$this->categoria = $retorno;
        			}
        		}
        	}
        }
        
        public function set_marca($url_marca) : void {
        	if (!empty($url_marca)) {
        		$url_marca = trim($url_marca);
        		
        		if (strip_tags($url_marca) === $url_marca) {
	        		$retorno = DAO_Marca::Buscar_ID_Por_URL($this->categoria, $url_marca);
	        		
	        		if (!empty($retorno) AND $retorno !== false) {
	        			$this->marca = $retorno;
	        		}
        		}
        	}
        }
        
        public function set_modelo($url_modelo) : void {
        	if (!empty($url_modelo)) {
        		$url_modelo = trim($url_modelo);
        		
        		if (strip_tags($url_modelo) === $url_modelo) {
	        		$retorno = DAO_Modelo::Buscar_ID_Por_URL($this->marca, $url_modelo);
	        		
	        		if (!empty($retorno) AND $retorno !== false) {
	        			$this->modelo = $retorno;
	        		}
        		}
        	}
        }
        
        public function set_versao($url_versao) : void {
        	if (!empty($url_versao)) {
        		$url_versao = trim($url_versao);
        		
        		if (strip_tags($url_versao) === $url_versao) {
	        		$retorno = DAO_Versao::Buscar_ID_Por_URL($this->modelo, $url_versao);
	        		
	        		if (!empty($retorno) AND $retorno !== false) {
	        			$this->versao = $retorno;
	        		}
        		}
        	}
        }
        
        public function set_ano_de($ano_de) : void {
        	if (!empty($ano_de)) {
        		$ano_de = trim($ano_de);
        		
        		if (filter_var($ano_de, FILTER_VALIDATE_INT) !== false) {
        			 $this->ano_de = $ano_de;
        		}
        	}
        }
        
        public function set_ano_ate($ano_ate) : void {
        	if (!empty($ano_ate)) {
        		$ano_ate = trim($ano_ate);
        		
        		if (filter_var($ano_ate, FILTER_VALIDATE_INT) !== false) {
        			$this->ano_ate = $ano_ate;
        		}
        	}
        }
        
        public function set_peca($peca) : void {
        	if (!empty($peca)) {
        		$peca = trim($peca);
        		
        		if (strip_tags($peca) === $peca) {
        			$this->peca = $peca;
        		}
        	}
        }
        
        public function get_pagina() : ?int {
        	return $this->pagina;
        }
        
        public function get_paginas() : ?int {
        	return $this->paginas;
        }
        
        public function Retornar_Marcas_Por_Categoria() {
        	View_Pesquisa::Carregar_Marcas($_GET['categoria']);
        }
        
        public function Retornar_Modelos_Por_Marca() {
        	View_Pesquisa::Carregar_Modelos($_GET['marca']);
        }
        
        public function Retornar_Versoes_Por_Modelo() {
        	View_Pesquisa::Carregar_Versoes($_GET['modelo']);
        }
        
        public static function Buscar_Todas_Categorias() {
        	return DAO_Categoria::BuscarTodos();
        }
        
        public static function Buscar_Marca_Por_Id_Categoria(?int $categoria) {
        	if (!empty($categoria)) {
        		return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
        	} else {
        		return null;
        	}
        }
        
        public static function Buscar_Modelo_Por_Id_Marca(?int $marca) {
        	if (!empty($marca)) {
        		return DAO_Modelo::Buscar_Por_ID_Marca($marca);
        	} else {
        		return null;
        	}
        }
        
        public static function Buscar_Versoes_Por_Id_Modelo(?int $modelo) {
        	if (!empty($modelo)) {
        		return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
        	} else {
        		return null;
        	}
        }
        
        protected function Validar_Variaveis() {
        	
        	
        	return true;
        }
        
        protected function Buscar_Pecas() : ?array {
        	$object_peca = new Object_Peca();
        	$retorno = null;
        	 
        	if (!empty($this->versao)) {
        		$retorno = $this->Buscar_Por_Versao($object_peca);
        	} else if (!empty($this->modelo)) {
        		$retorno = $this->Buscar_Por_Modelo($object_peca);
        	}  else if (!empty($this->marca)) {
        		$retorno = $this->Buscar_Por_Marca($object_peca);
        	} else if (!empty($this->categoria)) {
        		$retorno = $this->Buscar_Por_Categoria($object_peca);
        	}
        	
        	if (isset($retorno) AND !empty($retorno) AND $retorno !== false) {
        		return $retorno;
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Por_Categoria(Object_Peca $object_peca) {
        	$object_categoria_pativel = new Object_Categoria_Pativel();
        	
        	$object_categoria_pativel->set_categoria_id($this->categoria);
        	$object_categoria_pativel->set_ano_de($this->ano_de);
        	$object_categoria_pativel->set_ano_ate($this->ano_ate);
        	
        	$this->set_paginas(DAO_Categoria_Pativel::Buscar_Numero_Paginas($object_categoria_pativel, $object_peca));
        	
        	return DAO_Categoria_Pativel::Buscar_Pecas($object_categoria_pativel, $object_peca, $this->pagina);
        }
        
        private function Buscar_Por_Marca(Object_Peca $object_peca) {
        	$object_marca_pativel = new Object_Marca_Pativel();
        	
        	$object_marca_pativel->set_marca_id($this->marca);
        	$object_marca_pativel->set_ano_de($this->ano_de);
        	$object_marca_pativel->set_ano_ate($this->ano_ate);
        	
        	$this->set_paginas(DAO_Marca_Pativel::Buscar_Numero_Paginas($object_marca_pativel, $object_peca));
        	 
        	return DAO_Marca_Pativel::Buscar_Pecas($object_marca_pativel, $object_peca, $this->pagina);
        }
        
        private function Buscar_Por_Modelo(Object_Peca $object_peca) {
        	$object_modelo_pativel = new Object_Modelo_Pativel();
        	
        	$object_modelo_pativel->set_modelo_id($this->modelo);
        	$object_modelo_pativel->set_ano_de($this->ano_de);
        	$object_modelo_pativel->set_ano_ate($this->ano_ate);
        	
        	$this->set_paginas(DAO_Modelo_Pativel::Buscar_Numero_Paginas($object_modelo_pativel, $object_peca));
        	
        	return DAO_Modelo_Pativel::Buscar_Pecas($object_modelo_pativel, $object_peca, $this->pagina);
        }
        
        private function Buscar_Por_Versao(Object_Peca $object_peca) {
        	$object_versao_pativel = new Object_Versao_Pativel();
        	
        	$object_versao_pativel->set_versao_id($this->versao);
        	$object_versao_pativel->set_ano_de($this->ano_de);
        	$object_versao_pativel->set_ano_ate($this->ano_ate);
        	
        	$this->set_paginas(DAO_Versao_Pativel::Buscar_Numero_Paginas($object_versao_pativel, $object_peca));
        	 
        	return DAO_Versao_Pativel::Buscar_Pecas($object_versao_pativel, $object_peca, $this->pagina);
        }
    }
?>