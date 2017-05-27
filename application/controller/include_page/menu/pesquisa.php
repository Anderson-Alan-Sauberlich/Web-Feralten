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
	use \Exception;
	
    class Pesquisa {

        function __construct() {
            $this->object_peca = new Object_Peca();
        }
        
        private $form_pesquisar = array();
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
        
        public function set_categoria($categoria): void {
        	try {
        		$this->categoria = Filtro::Categoria()::validar_id($categoria);
        	} catch (Exception $e) {
        		$this->categoria = Filtro::Categoria()::filtrar_id($categoria);
        	}
        }
        
        public function set_marca($marca) : void {
        	try {
        		$this->marca = Filtro::Marca()::validar_id($marca);
        	} catch (Exception $e) {
        		$this->marca = Filtro::Marca()::filtrar_id($marca);
        	}
        }
        
        public function set_modelo($modelo) : void {
        	try {
        		$this->modelo = Filtro::Modelo()::validar_id($modelo);
        	} catch (Exception $e) {
        		$this->modelo = Filtro::Modelo()::filtrar_id($modelo);
        	}
        }
        
        public function set_versao($versao) : void {
        	try {
        		$this->versao = Filtro::Versao()::validar_id($versao);
        	} catch (Exception $e) {
        		$this->versao = Filtro::Versao()::filtrar_id($versao);
        	}
        }
        
        public function set_categoria_url($url_categoria) : void {
        	try {
        		$this->set_categoria(DAO_Categoria::Buscar_ID_Por_URL(Filtro::Categoria()::validar_url($url_categoria)));
        	} catch (Exception $e) {
        		$this->categoria = 0;
        	}
        }
        
        public function set_marca_url($url_marca) : void {
        	try {
        		$this->set_marca(DAO_Marca::Buscar_ID_Por_URL($this->categoria, Filtro::Marca()::validar_url($url_marca)));
        	} catch (Exception $e) {
        		$this->marca = 0;
        	}
        }
        
        public function set_modelo_url($url_modelo) : void {
        	try {
        		$this->set_modelo(DAO_Modelo::Buscar_ID_Por_URL($this->marca, Filtro::Modelo()::validar_url($url_modelo)));
        	} catch (Exception $e) {
        		$this->modelo = 0;
        	}
        }
        
        public function set_versao_url($url_versao) : void {
        	try {
        		$this->set_versao(DAO_Versao::Buscar_ID_Por_URL($this->modelo, Filtro::Versao()::validar_url($url_versao)));
        	} catch (Exception $e) {
        		$this->versao = 0;
        	}
        }
        
        public function set_ano_de($ano_de) : void {
        	try {
        		$this->ano_de = Filtro::Categoria_Pativel()::validar_ano_de($ano_de);
        	} catch (Exception $e) {
        		$this->ano_de = Filtro::Categoria_Pativel()::filtrar_ano_de($ano_de);
        	}
        }
        
        public function set_ano_ate($ano_ate) : void {
        	try {
        		$this->ano_ate = Filtro::Categoria_Pativel()::validar_ano_ate($ano_ate);
        	} catch (Exception $e) {
        		$this->ano_ate = Filtro::Categoria_Pativel()::filtrar_ano_ate($ano_ate);
        	}
        }
        
        public function set_peca_nome($nome_peca) : void {
        	try {
        		$this->object_peca->set_nome(Filtro::Peca()::validar_nome($nome_peca));
        	} catch (Exception $e) {
        		
        	}
        }
        
        public function set_peca_usuario(int $id_usuario = null) : void {
        	try {
        		$entidade = new Object_Entidade();
        		$entidade->set_usuario_id(Filtro::Peca()::validar_responsavel($id_usuario));
        		$this->object_peca->set_entidade($entidade);
        	} catch (Exception $e) {
        		
        	}
        }
        
        public function get_pagina() : ?int {
        	return $this->pagina;
        }
        
        public function get_paginas() : ?int {
        	return $this->paginas;
        }
        
        public function get_form() : ?array {
        	$this->form_pesquisar['categoria'] = $this->categoria;
        	$this->form_pesquisar['marca'] = $this->marca;
        	$this->form_pesquisar['modelo'] = $this->modelo;
        	$this->form_pesquisar['versao'] = $this->versao;
        	$this->form_pesquisar['peca_nome'] = $this->object_peca->get_nome();
        	$this->form_pesquisar['ano_de'] = $this->ano_de;
        	$this->form_pesquisar['ano_ate'] = $this->ano_ate;
        	
        	return $this->form_pesquisar;
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