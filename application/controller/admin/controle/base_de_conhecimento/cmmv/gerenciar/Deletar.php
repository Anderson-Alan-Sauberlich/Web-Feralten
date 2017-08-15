<?php
namespace application\controller\admin\controle\base_de_conhecimento\cmmv\gerenciar;
	
	use application\model\dao\Categoria as DAO_Categoria;
	use application\model\dao\Marca as DAO_Marca;
	use application\model\dao\Modelo as DAO_Modelo;
	use application\model\dao\Versao as DAO_Versao;
	use application\model\object\Versao as Object_Versao;
	use application\model\object\Modelo as Object_Modelo;
	use application\model\object\Marca as Object_Marca;
	use application\model\object\Categoria as Object_Categoria;
	use application\controller\include_page\menu\Admin as Controller_Admin;
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\gerenciar\Deletar as View_Deletar;
	
    class Deletar {

        function __construct() {
            
        }
        
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $nome;
        private $url;
        
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
        
        public function set_nome($nome) {
        	$this->nome = $nome;
        }
        
        public function set_url($url) {
        	$this->url = $url;
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Admin::Verificar_Autenticacao()) {
	        	$view = new View_Deletar();
	        	
	        	$view->set_categorias(DAO_Categoria::BuscarTodos());
	        	
	        	$view->Executar();
        	} else {
        		return false;
        	}
        }
        
        public function Deletar_CMMV() : void {
        	if (!empty($this->versao)) {
        		$this->Deletar_Versao();
        	} else if (!empty($this->modelo)) {
        		$this->Deletar_Modelo();
        	} else if (!empty($this->marca)) {
        		$this->Deletar_Marca();
        	} else if (!empty($this->categoria)) {
        		$this->Deletar_Categoria();
        	}
        }
        
        private function Deletar_Versao() : void {
        	if (!DAO_Versao::Deletar($this->versao)) {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Deletar Versão Falhou</b></div>";
        	}
        }
        
        private function Deletar_Modelo() : void {
        	if (!DAO_Modelo::Deletar($this->modelo)) {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Deletar Modelo Falhou</b></div>";
        	}
        }
        
        private function Deletar_Marca() : void {
        	if (!DAO_Marca::Deletar($this->marca)) {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Deletar Marca Falhou</b></div>";
        	}
        }
        
        private function Deletar_Categoria() : void {
        	if (!DAO_Categoria::Deletar($this->categoria)) {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Deletar Categoria Falhou</b></div>";
        	}
        }
        
        public function Retornar_Categoria() : void {
        	$object_categoria = $this->Buscar_Categoria_Por_Id($this->categoria);
        	 
        	if (!empty($object_categoria)) {
        		$categoria = array();
        
        		$categoria['nome'] = $object_categoria->get_nome();
        		$categoria['url'] = $object_categoria->get_url();
        
        		echo json_encode($categoria);
        	}
        }
        
        public function Retornar_Marca() : void {
        	$object_marca = $this->Buscar_Marca_Por_Id($this->marca);
        
        	if (!empty($object_marca)) {
        		$marca = array();
        
        		$marca['nome'] = $object_marca->get_nome();
        		$marca['url'] = $object_marca->get_url();
        
        		echo json_encode($marca);
        	}
        }
        
        public function Retornar_Modelo() : void {
        	$object_modelo = $this->Buscar_Modelo_Por_Id($this->modelo);
        
        	if (!empty($object_modelo)) {
        		$modelo = array();
        
        		$modelo['nome'] = $object_modelo->get_nome();
        		$modelo['url'] = $object_modelo->get_url();
        
        		echo json_encode($modelo);
        	}
        }
        
        public function Retornar_Versao() : void {
        	$object_versao = $this->Buscar_Versao_Por_Id($this->versao);
        
        	if (!empty($object_versao)) {
        		$versao = array();
        
        		$versao['nome'] = $object_versao->get_nome();
        		$versao['url'] = $object_versao->get_url();
        
        		echo json_encode($versao);
        	}
        }
        
        public function Retornar_Categorias() : void {
        	View_Deletar::Carregar_Categorias(DAO_Categoria::BuscarTodos());
        }
        
        public function Retornar_Marcas_Por_Categoria() : void {
        	View_Deletar::Carregar_Marcas($this->Buscar_Marca_Por_Id_Categoria($this->categoria));
        }
        
        public function Retornar_Modelos_Por_Marca() : void {
        	View_Deletar::Carregar_Modelos($this->Buscar_Modelo_Por_Id_Marca($this->marca));
        }
        
        public function Retornar_Versoes_Por_Modelo() : void {
        	View_Deletar::Carregar_Versoes($this->Buscar_Versoes_Por_Id_Modelo($this->modelo));
        }
        
        private function Buscar_Marca_Por_Id_Categoria(?int $categoria) {
        	if (!empty($categoria)) {
        		return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Modelo_Por_Id_Marca(?int $marca) {
        	if (!empty($marca)) {
        		return DAO_Modelo::Buscar_Por_ID_Marca($marca);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Versoes_Por_Id_Modelo(?int $modelo) {
        	if (!empty($modelo)) {
        		return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Categoria_Por_Id(?int $categoria) {
        	if (!empty($categoria)) {
        		return DAO_Categoria::Buscar_Nome_URL_Por_ID($categoria);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Marca_Por_Id(?int $marca) {
        	if (!empty($marca)) {
        		return DAO_Marca::Buscar_Nome_URL_Por_ID($marca);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Modelo_Por_Id(?int $modelo) {
        	if (!empty($modelo)) {
        		return DAO_Modelo::Buscar_Nome_URL_Por_ID($modelo);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Versao_Por_Id(?int $versao) {
        	if (!empty($versao)) {
        		return DAO_Versao::Buscar_Nome_URL_Por_ID($versao);
        	} else {
        		return null;
        	}
        }
    }
?>