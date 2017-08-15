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
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\gerenciar\Cadastrar as View_Cadastrar;
					
    class Cadastrar {

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
	        	$view = new View_Cadastrar();
	        	
	        	$view->set_categorias(DAO_Categoria::BuscarTodos());
	        	
	        	$view->Executar();
	        } else {
	        	return false;
	        }
        }
        
        public function Cadastrar_CMMV() : void {
        	if (!empty($this->modelo)) {
        		$this->Cadastrar_Versao();
        	} else if (!empty($this->marca)) {
        		$this->Cadastrar_Modelo();
        	} else if (!empty($this->categoria)) {
        		$this->Cadastrar_Marca();
        	} else {
        		$this->Cadastrar_Categoria();
        	}
        }
        
        private function Cadastrar_Versao() : void {
        	if ($this->Validar_Nome_URL()) {
        		$object_versao = new Object_Versao();
        		
        		$object_versao->set_modelo_id($this->modelo);
        		$object_versao->set_nome($this->nome);
        		$object_versao->set_url($this->url);
        		
        		if (DAO_Versao::Verificar_Versao_Repetida($object_versao)) {
        		    DAO_Versao::Inserir($object_versao);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Versão Nome/URL Já Estão Cadastrados Para Este Modelo</b></div>";
        		}
        	}
        }
        
        private function Cadastrar_Modelo() : void {
        	if ($this->Validar_Nome_URL()) {
        		$object_modelo = new Object_Modelo();
        		
        		$object_modelo->set_marca_id($this->marca);
        		$object_modelo->set_nome($this->nome);
        		$object_modelo->set_url($this->url);
        		
        		if (DAO_Modelo::Verificar_Modelo_Repetido($object_modelo)) {
        		    DAO_Modelo::Inserir($object_modelo);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Modelo Nome/URL Já Estão Cadastrados Para Está Marca</b></div>";
        		}
        	}
        }
        
        private function Cadastrar_Marca() : void {
        	if ($this->Validar_Nome_URL()) {
        		$object_marca = new Object_Marca();
        		
        		$object_marca->set_categoria_id($this->categoria);
        		$object_marca->set_nome($this->nome);
        		$object_marca->set_url($this->url);
        		
        		if (DAO_Marca::Verificar_Marca_Repetida($object_marca)) {
        		    DAO_Marca::Inserir($object_marca);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Marca Nome/URL Já Estão Cadastrados Para Está Categoria</b></div>";
        		}
        	}
        }
        
        private function Cadastrar_Categoria() : void {
        	if ($this->Validar_Nome_URL()) {
        		$object_categoria = new Object_Categoria();
        		
        		$object_categoria->set_nome($this->nome);
        		$object_categoria->set_url($this->url);
        		
        		if (DAO_Categoria::Verificar_Categoria_Repetida($object_categoria)) {
        		    DAO_Categoria::Inserir($object_categoria);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Categoria Nome/URL Já Estão Cadastrados</b></div>";
        		}
        	}
        }
        
        private function Validar_Nome_URL() : bool {
        	if (!empty($this->nome) AND !empty($this->url)) {
        		return true;
        	} else {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Nome/URL Não Informado</b></div>";
        		
        		return false;
        	}
        }
        
        public function Retornar_Categorias() : void {
        	View_Cadastrar::Carregar_Categorias(DAO_Categoria::BuscarTodos());
        }
        
        public function Retornar_Marcas_Por_Categoria() : void {
        	View_Cadastrar::Carregar_Marcas($this->Buscar_Marca_Por_Id_Categoria($this->categoria));
        }
        
        public function Retornar_Modelos_Por_Marca() : void {
        	View_Cadastrar::Carregar_Modelos($this->Buscar_Modelo_Por_Id_Marca($this->marca));
        }
        
        public function Retornar_Versoes_Por_Modelo() : void {
        	View_Cadastrar::Carregar_Versoes($this->Buscar_Versoes_Por_Id_Modelo($this->modelo));
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
    }
?>