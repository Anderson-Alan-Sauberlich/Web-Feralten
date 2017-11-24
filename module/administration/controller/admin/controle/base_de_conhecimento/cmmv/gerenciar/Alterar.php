<?php
namespace module\administration\controller\admin\controle\base_de_conhecimento\cmmv\gerenciar;
	
	use module\application\model\dao\Categoria as DAO_Categoria;
	use module\application\model\dao\Marca as DAO_Marca;
	use module\application\model\dao\Modelo as DAO_Modelo;
	use module\application\model\dao\Versao as DAO_Versao;
	use module\application\model\object\Versao as Object_Versao;
	use module\application\model\object\Modelo as Object_Modelo;
	use module\application\model\object\Marca as Object_Marca;
	use module\application\model\object\Categoria as Object_Categoria;
	use module\administration\controller\layout\menu\Admin as Controller_Admin;
	use module\administration\view\src\admin\controle\base_de_conhecimento\cmmv\gerenciar\Alterar as View_Alterar;
	
    class Alterar
    {

        function __construct()
        {
            
        }
        
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $nome;
        private $url;
        
        public function set_categoria($categoria) : void
        {
        	if (filter_var($categoria, FILTER_VALIDATE_INT) !== false) {
        		$this->categoria = $categoria;
        	}
        }
        
        public function set_marca($marca) : void
        {
        	if (filter_var($marca, FILTER_VALIDATE_INT) !== false) {
        		$this->marca = $marca;
        	}
        }
        
        public function set_modelo($modelo) : void
        {
        	if (filter_var($modelo, FILTER_VALIDATE_INT) !== false) {
        		$this->modelo = $modelo;
        	}
        }
        
        public function set_versao($versao) : void
        {
        	if (filter_var($versao, FILTER_VALIDATE_INT) !== false) {
        		$this->versao = $versao;
        	}
        }
        
        public function set_nome($nome) : void
        {
        	$this->nome = $nome;
        }
        
        public function set_url($url) : void
        {
        	$this->url = $url;
        }
        
        public function Carregar_Pagina()
        {
        	if (Controller_Admin::Verificar_Autenticacao()) {
	        	$view = new View_Alterar();
	        	
	        	$view->set_categorias(DAO_Categoria::BuscarTodos());
	        	
	        	$view->Executar();
        	} else {
        		return false;
        	}
        }
        
        public function Alterar_CMMV() : void
        {
        	if (!empty($this->versao)) {
        		$this->Alterar_Versao();
        	} else if (!empty($this->modelo)) {
        		$this->Alterar_Modelo();
        	} else if (!empty($this->marca)) {
        		$this->Alterar_Marca();
        	} else if (!empty($this->categoria)) {
        		$this->Alterar_Categoria();
        	}
        }
        
        private function Alterar_Versao() : void
        {
        	if ($this->Validar_Nome_URL()) {
        		$object_versao = new Object_Versao();
        		
        		$object_versao->set_id($this->versao);
        		$object_versao->set_modelo_id($this->modelo);
        		$object_versao->set_nome($this->nome);
        		$object_versao->set_url($this->url);
        
        		if (DAO_Versao::Verificar_Versao_Repetida($object_versao)) {
        			DAO_Versao::Atualizar($object_versao);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Versão Nome/URL Já Estão Cadastrados Para Este Modelo</b></div>";
        		}
        	}
        }
        
        private function Alterar_Modelo() : void
        {
        	if ($this->Validar_Nome_URL()) {
        		$object_modelo = new Object_Modelo();
        		
        		$object_modelo->set_id($this->modelo);
        		$object_modelo->set_marca_id($this->marca);
        		$object_modelo->set_nome($this->nome);
        		$object_modelo->set_url($this->url);
        
        		if (DAO_Modelo::Verificar_Modelo_Repetido($object_modelo)) {
        			DAO_Modelo::Atualizar($object_modelo);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Modelo Nome/URL Já Estão Cadastrados Para Está Marca</b></div>";
        		}
        	}
        }
        
        private function Alterar_Marca() : void
        {
        	if ($this->Validar_Nome_URL()) {
        		$object_marca = new Object_Marca();
        		
        		$object_marca->set_id($this->marca);
        		$object_marca->set_categoria_id($this->categoria);
        		$object_marca->set_nome($this->nome);
        		$object_marca->set_url($this->url);
        
        		if (DAO_Marca::Verificar_Marca_Repetida($object_marca)) {
        			DAO_Marca::Atualizar($object_marca);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Marca Nome/URL Já Estão Cadastrados Para Está Categoria</b></div>";
        		}
        	}
        }
        
        private function Alterar_Categoria() : void
        {
        	if ($this->Validar_Nome_URL()) {
        		$object_categoria = new Object_Categoria();
        
        		$object_categoria->set_id($this->categoria);
        		$object_categoria->set_nome($this->nome);
        		$object_categoria->set_url($this->url);
        
        		if (DAO_Categoria::Verificar_Categoria_Repetida($object_categoria)) {
        			DAO_Categoria::Atualizar($object_categoria);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Categoria Nome/URL Já Estão Cadastrados</b></div>";
        		}
        	}
        }
        
        private function Validar_Nome_URL() : bool
        {
        	if (!empty($this->nome) AND !empty($this->url)) {
        		return true;
        	} else {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Nome/URL Não Informado</b></div>";
        
        		return false;
        	}
        }
        
        public function Retornar_Categoria() : void
        {
        	$object_categoria = $this->Buscar_Categoria_Por_Id($this->categoria);
        	
        	if (!empty($object_categoria)) {
        		$categoria = array();
        		
        		$categoria['nome'] = $object_categoria->get_nome();
        		$categoria['url'] = $object_categoria->get_url();
        		
        		echo json_encode($categoria);
        	}
        }
        
        public function Retornar_Marca() : void
        {
        	$object_marca = $this->Buscar_Marca_Por_Id($this->marca);
        	 
        	if (!empty($object_marca)) {
        		$marca = array();
        
        		$marca['nome'] = $object_marca->get_nome();
        		$marca['url'] = $object_marca->get_url();
        
        		echo json_encode($marca);
        	}
        }
        
        public function Retornar_Modelo() : void
        {
        	$object_modelo = $this->Buscar_Modelo_Por_Id($this->modelo);
        
        	if (!empty($object_modelo)) {
        		$modelo = array();
        
        		$modelo['nome'] = $object_modelo->get_nome();
        		$modelo['url'] = $object_modelo->get_url();
        
        		echo json_encode($modelo);
        	}
        }
        
        public function Retornar_Versao() : void
        {
        	$object_versao = $this->Buscar_Versao_Por_Id($this->versao);
        
        	if (!empty($object_versao)) {
        		$versao = array();
        
        		$versao['nome'] = $object_versao->get_nome();
        		$versao['url'] = $object_versao->get_url();
        
        		echo json_encode($versao);
        	}
        }
        
        public function Retornar_Categorias() : void
        {
        	View_Alterar::Carregar_Categorias(DAO_Categoria::BuscarTodos());
        }
        
        public function Retornar_Marcas_Por_Categoria() : void
        {
        	View_Alterar::Carregar_Marcas($this->Buscar_Marca_Por_Id_Categoria($this->categoria));
        }
        
        public function Retornar_Modelos_Por_Marca() : void
        {
        	View_Alterar::Carregar_Modelos($this->Buscar_Modelo_Por_Id_Marca($this->marca));
        }
        
        public function Retornar_Versoes_Por_Modelo() : void
        {
        	View_Alterar::Carregar_Versoes($this->Buscar_Versoes_Por_Id_Modelo($this->modelo));
        }
        
        private function Buscar_Marca_Por_Id_Categoria(?int $categoria)
        {
        	if (!empty($categoria)) {
        		return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Modelo_Por_Id_Marca(?int $marca)
        {
        	if (!empty($marca)) {
        		return DAO_Modelo::Buscar_Por_ID_Marca($marca);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Versoes_Por_Id_Modelo(?int $modelo)
        {
        	if (!empty($modelo)) {
        		return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Categoria_Por_Id(?int $categoria)
        {
        	if (!empty($categoria)) {
        		return DAO_Categoria::Buscar_Nome_URL_Por_ID($categoria);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Marca_Por_Id(?int $marca)
        {
        	if (!empty($marca)) {
        		return DAO_Marca::Buscar_Nome_URL_Por_ID($marca);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Modelo_Por_Id(?int $modelo)
        {
        	if (!empty($modelo)) {
        		return DAO_Modelo::Buscar_Nome_URL_Por_ID($modelo);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Versao_Por_Id(?int $versao)
        {
        	if (!empty($versao)) {
        		return DAO_Versao::Buscar_Nome_URL_Por_ID($versao);
        	} else {
        		return null;
        	}
        }
    }
