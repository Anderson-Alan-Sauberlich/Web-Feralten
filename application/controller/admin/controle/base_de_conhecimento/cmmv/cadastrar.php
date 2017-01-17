<?php
namespace application\controller\admin\controle\base_de_conhecimento\cmmv;
	
	require_once RAIZ.'/application/model/dao/categoria.php';
	require_once RAIZ.'/application/model/dao/marca.php';
	require_once RAIZ.'/application/model/dao/modelo.php';
	require_once RAIZ.'/application/model/dao/versao.php';
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/cadastrar.php';
	
	use application\model\dao\Categoria as DAO_Categoria;
	use application\model\dao\Marca as DAO_Marca;
	use application\model\dao\Modelo as DAO_Modelo;
	use application\model\dao\Versao as DAO_Versao;
	use application\model\object\Versao as Object_Versao;
	use application\model\object\Modelo as Object_Modelo;
	use application\model\object\Marca as Object_Marca;
	use application\model\object\Categoria as Object_Categoria;
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\Cadastrar as View_Cadastrar;
					
    class Cadastrar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Cadastrar();
        	
        	$view->set_categorias(DAO_Categoria::BuscarTodos());
        	
        	$view->Executar();
        }
        
        public function Cadastrar_CMMV() {
        	if (!empty($_POST['modelo'])) {
        		$this->Cadastrar_Versao();
        	} else if (!empty($_POST['marca'])) {
        		$this->Cadastrar_Modelo();
        	} else if (!empty($_POST['categoria'])) {
        		$this->Cadastrar_Marca();
        	} else {
        		$this->Cadastrar_Categoria();
        	}
        }
        
        private function Cadastrar_Versao() {
        	if ($this->Validar_Nome_URL()) {
        		$object_versao = new Object_Versao();
        		
        		$object_versao->set_modelo_id($_POST['modelo']);
        		$object_versao->set_nome($_POST['nome']);
        		$object_versao->set_url($_POST['url']);
        		
        		if (DAO_Versao::Verificar_Versao_Repetida($object_versao)) {
        			DAO_Versao::Inserir($object_versao);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Versão Nome/URL Já Estão Cadastrados Para Este Modelo</b></div>";
        		}
        	}
        }
        
        private function Cadastrar_Modelo() {
        	if ($this->Validar_Nome_URL()) {
        		$object_modelo = new Object_Modelo();
        		
        		$object_modelo->set_marca_id($_POST['marca']);
        		$object_modelo->set_nome($_POST['nome']);
        		$object_modelo->set_url($_POST['url']);
        		
        		if (DAO_Modelo::Verificar_Modelo_Repetido($object_modelo)) {
        			DAO_Modelo::Inserir($object_modelo);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Modelo Nome/URL Já Estão Cadastrados Para Está Marca</b></div>";
        		}
        	}
        }
        
        private function Cadastrar_Marca() {
        	if ($this->Validar_Nome_URL()) {
        		$object_marca = new Object_Marca();
        		
        		$object_marca->set_categoria_id($_POST['categoria']);
        		$object_marca->set_nome($_POST['nome']);
        		$object_marca->set_url($_POST['url']);
        		
        		if (DAO_Marca::Verificar_Marca_Repetida($object_marca)) {
        			DAO_Marca::Inserir($object_marca);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Marca Nome/URL Já Estão Cadastrados Para Está Categoria</b></div>";
        		}
        	}
        }
        
        private function Cadastrar_Categoria() {
        	if ($this->Validar_Nome_URL()) {
        		$object_categoria = new Object_Categoria();
        		
        		$object_categoria->set_nome($_POST['nome']);
        		$object_categoria->set_url($_POST['url']);
        		
        		if (DAO_Categoria::Verificar_Categoria_Repetida($object_categoria)) {
        			DAO_Categoria::Inserir($object_categoria);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Categoria Nome/URL Já Estão Cadastrados</b></div>";
        		}
        	}
        }
        
        private function Validar_Nome_URL() {
        	if (!empty($_POST['nome']) AND !empty($_POST['url'])) {
        		return true;
        	} else {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Nome/URL Não Informado</b></div>";
        		
        		return false;
        	}
        }
        
        public function Retornar_Marcas_Por_Categoria() {
        	View_Cadastrar::Carregar_Marcas($this->Buscar_Marca_Por_Id_Categoria($_GET['categoria']));
        }
        
        public function Retornar_Modelos_Por_Marca() {
        	View_Cadastrar::Carregar_Modelos($this->Buscar_Modelo_Por_Id_Marca($_GET['marca']));
        }
        
        public function Retornar_Versoes_Por_Modelo() {
        	View_Cadastrar::Carregar_Versoes($this->Buscar_Versoes_Por_Id_Modelo($_GET['modelo']));
        }
        
        public function Buscar_Marca_Por_Id_Categoria($categoria) {
        	if (!empty($categoria)) {
        		return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
        	} else {
        		return null;
        	}
        }
        
        public function Buscar_Modelo_Por_Id_Marca($marca) {
        	if (!empty($marca)) {
        		return DAO_Modelo::Buscar_Por_ID_Marca($marca);
        	} else {
        		return null;
        	}
        }
        
        public function Buscar_Versoes_Por_Id_Modelo($modelo) {
        	if (!empty($modelo)) {
        		return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
        	} else {
        		return null;
        	}
        }
    }
?>