<?php
namespace application\controller\include_page\menu;
	
	require_once RAIZ.'/application/model/common/util/filtro.php';
	require_once RAIZ.'/application/view/src/include_page/menu/pesquisa.php';
	require_once RAIZ.'/application/model/dao/peca.php';
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
	require_once RAIZ.'/application/model/object/entidade.php';
	
	use application\model\common\util\Filtro;
	use application\view\src\include_page\menu\Pesquisa as View_Pesquisa;
	use application\model\dao\Peca as DAO_Peca;
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
	use application\model\object\Entidade as Object_Entidade;
	
    class Pesquisa {

        function __construct() {
            $this->object_peca = new Object_Peca();
        }
        
        private $pagina = 0;
        private $paginas = 0;
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $ano_de;
        private $ano_ate;
        private $object_peca;
        
        public function set_pagina($pagina) : void {
        	if (!empty($pagina)) {
        		$pagina = trim($pagina);
        		
	        	if (filter_var($pagina, FILTER_VALIDATE_INT) !== false) {
	        		$this->pagina = $pagina;
	        	} else {
	        		$this->pagina = 0;
	        	}
        	} else {
        		$this->pagina = 0;
        	}
        }
        
        public function set_paginas($paginas) : void {
        	if ($paginas !== false) {
	        	if (!empty($paginas)) {
	        		if (filter_var($paginas, FILTER_VALIDATE_INT) !== false) {
		        		$this->paginas = $paginas;
		        		
		        		if (empty($this->pagina) OR $this->pagina <= 0) {
		        			$this->pagina = 1;
		        		} else if ($this->pagina > $this->paginas) {
		        			$this->pagina = $this->paginas;
		        		}
	        		} else {
	        			$this->pagina = 0;
	        		}
	        	} else {
	        		$this->pagina = 0;
	        	}
        	} else {
        		$this->pagina = 0;
        	}
        }
        
        public function set_categoria($categoria) {
        	if (filter_var($categoria, FILTER_VALIDATE_INT) !== false) {
        		$this->categoria = $categoria;
        	}
        }
        
        public function set_marca($marca) {
        	if (filter_var($marca, FILTER_VALIDATE_INT) !== false) {
        		$this->marca = $marca;
        	}
        }
        
        public function set_modelo($modelo) {
        	if (filter_var($modelo, FILTER_VALIDATE_INT) !== false) {
        		$this->modelo = $modelo;
        	}
        }
        
        public function set_versao($versao) {
        	if (filter_var($versao, FILTER_VALIDATE_INT) !== false) {
        		$this->versao = $versao;
        	}
        }
        
        public function set_categoria_url($url_categoria) : void {
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
        
        public function set_marca_url($url_marca) : void {
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
        
        public function set_modelo_url($url_modelo) : void {
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
        
        public function set_versao_url($url_versao) : void {
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
        
        public function set_peca_nome($nome_peca) : void {
        	if (!empty($nome_peca)) {
        		$nome_peca = trim($nome_peca);
        		
        		if (strip_tags($nome_peca) === $nome_peca) {
        			$this->object_peca->set_nome($nome_peca);
        		}
        	}
        }
        
        public function set_peca_usuario(int $id_usuario = null) : void {
        	if (!empty($id_usuario)) {
        		if (filter_var($id_usuario, FILTER_VALIDATE_INT) !== false) {
        			$entidade = new Object_Entidade();
        			$entidade->set_usuario_id($id_usuario);
        			$this->object_peca->set_entidade($entidade);
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
        	View_Pesquisa::Carregar_Marcas($this->categoria);
        }
        
        public function Retornar_Modelos_Por_Marca() {
        	View_Pesquisa::Carregar_Modelos($this->marca);
        }
        
        public function Retornar_Versoes_Por_Modelo() {
        	View_Pesquisa::Carregar_Versoes($this->modelo);
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
        
        public function Buscar_Pecas() : ?array {
        	$retorno = null;
        	 
        	if (!empty($this->versao)) {
        		$retorno = $this->Buscar_Por_Versao();
        	} else if (!empty($this->modelo)) {
        		$retorno = $this->Buscar_Por_Modelo();
        	}  else if (!empty($this->marca)) {
        		$retorno = $this->Buscar_Por_Marca();
        	} else if (!empty($this->categoria)) {
        		$retorno = $this->Buscar_Por_Categoria();
        	} else {
        		$retorno = $this->Buscar_Por_Usuario();
        	}
        	
        	if (isset($retorno) AND !empty($retorno) AND $retorno !== false) {
        		return $retorno;
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Por_Usuario() {
        	$this->set_paginas(DAO_Peca::Buscar_Numero_Paginas($this->object_peca));
        	
        	return DAO_Peca::Buscar_Pecas($this->object_peca, $this->pagina);
        }
        
        private function Buscar_Por_Categoria() {
        	$object_categoria_pativel = new Object_Categoria_Pativel();
        	
        	$object_categoria_pativel->set_categoria_id($this->categoria);
        	$object_categoria_pativel->set_ano_de($this->ano_de);
        	$object_categoria_pativel->set_ano_ate($this->ano_ate);
        	
        	$this->set_paginas(DAO_Categoria_Pativel::Buscar_Numero_Paginas($object_categoria_pativel, $this->object_peca));
        	
        	return DAO_Categoria_Pativel::Buscar_Pecas($object_categoria_pativel, $this->object_peca, $this->pagina);
        }
        
        private function Buscar_Por_Marca() {
        	$object_marca_pativel = new Object_Marca_Pativel();
        	
        	$object_marca_pativel->set_marca_id($this->marca);
        	$object_marca_pativel->set_ano_de($this->ano_de);
        	$object_marca_pativel->set_ano_ate($this->ano_ate);
        	
        	$this->set_paginas(DAO_Marca_Pativel::Buscar_Numero_Paginas($object_marca_pativel, $this->object_peca));
        	 
        	return DAO_Marca_Pativel::Buscar_Pecas($object_marca_pativel, $this->object_peca, $this->pagina);
        }
        
        private function Buscar_Por_Modelo() {
        	$object_modelo_pativel = new Object_Modelo_Pativel();
        	
        	$object_modelo_pativel->set_modelo_id($this->modelo);
        	$object_modelo_pativel->set_ano_de($this->ano_de);
        	$object_modelo_pativel->set_ano_ate($this->ano_ate);
        	
        	$this->set_paginas(DAO_Modelo_Pativel::Buscar_Numero_Paginas($object_modelo_pativel, $this->object_peca));
        	
        	return DAO_Modelo_Pativel::Buscar_Pecas($object_modelo_pativel, $this->object_peca, $this->pagina);
        }
        
        private function Buscar_Por_Versao() {
        	$object_versao_pativel = new Object_Versao_Pativel();
        	
        	$object_versao_pativel->set_versao_id($this->versao);
        	$object_versao_pativel->set_ano_de($this->ano_de);
        	$object_versao_pativel->set_ano_ate($this->ano_ate);
        	
        	$this->set_paginas(DAO_Versao_Pativel::Buscar_Numero_Paginas($object_versao_pativel, $this->object_peca));
        	 
        	return DAO_Versao_Pativel::Buscar_Pecas($object_versao_pativel, $this->object_peca, $this->pagina);
        }
    }
?>