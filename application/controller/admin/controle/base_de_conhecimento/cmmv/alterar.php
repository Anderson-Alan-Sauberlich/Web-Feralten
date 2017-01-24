<?php
namespace application\controller\admin\controle\base_de_conhecimento\cmmv;
	
	require_once RAIZ.'/application/model/dao/categoria.php';
	require_once RAIZ.'/application/model/dao/marca.php';
	require_once RAIZ.'/application/model/dao/modelo.php';
	require_once RAIZ.'/application/model/dao/versao.php';
	require_once RAIZ.'/application/model/object/versao.php';
	require_once RAIZ.'/application/model/object/marca.php';
	require_once RAIZ.'/application/model/object/modelo.php';
	require_once RAIZ.'/application/model/object/versao.php';
	require_once RAIZ.'/application/controller/include_page/menu/admin.php';
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/alterar.php';
	
	use application\model\dao\Categoria as DAO_Categoria;
	use application\model\dao\Marca as DAO_Marca;
	use application\model\dao\Modelo as DAO_Modelo;
	use application\model\dao\Versao as DAO_Versao;
	use application\model\object\Versao as Object_Versao;
	use application\model\object\Modelo as Object_Modelo;
	use application\model\object\Marca as Object_Marca;
	use application\model\object\Categoria as Object_Categoria;
	use application\controller\include_page\menu\Admin as Controller_Admin;
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\Alterar as View_Alterar;
	
    class Alterar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Admin::Verificar_Autenticacao()) {
	        	$view = new View_Alterar();
	        	
	        	$view->set_categorias(DAO_Categoria::BuscarTodos());
	        	
	        	$view->Executar();
        	} else {
        		return false;
        	}
        }
        
        public function Alterar_CMMV() {
        	if (!empty($_POST['versao'])) {
        		$this->Alterar_Versao();
        	} else if (!empty($_POST['modelo'])) {
        		$this->Alterar_Modelo();
        	} else if (!empty($_POST['marca'])) {
        		$this->Alterar_Marca();
        	} else if (!empty($_POST['categoria'])) {
        		$this->Alterar_Categoria();
        	}
        }
        
        private function Alterar_Versao() {
        	if ($this->Validar_Nome_URL()) {
        		$object_versao = new Object_Versao();
        		
        		$object_versao->set_id($_POST['versao']);
        		$object_versao->set_modelo_id($_POST['modelo']);
        		$object_versao->set_nome($_POST['nome']);
        		$object_versao->set_url($_POST['url']);
        
        		if (DAO_Versao::Verificar_Versao_Repetida($object_versao)) {
        			DAO_Versao::Atualizar($object_versao);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Versão Nome/URL Já Estão Cadastrados Para Este Modelo</b></div>";
        		}
        	}
        }
        
        private function Alterar_Modelo() {
        	if ($this->Validar_Nome_URL()) {
        		$object_modelo = new Object_Modelo();
        		
        		$object_modelo->set_id($_POST['modelo']);
        		$object_modelo->set_marca_id($_POST['marca']);
        		$object_modelo->set_nome($_POST['nome']);
        		$object_modelo->set_url($_POST['url']);
        
        		if (DAO_Modelo::Verificar_Modelo_Repetido($object_modelo)) {
        			DAO_Modelo::Atualizar($object_modelo);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Modelo Nome/URL Já Estão Cadastrados Para Está Marca</b></div>";
        		}
        	}
        }
        
        private function Alterar_Marca() {
        	if ($this->Validar_Nome_URL()) {
        		$object_marca = new Object_Marca();
        		
        		$object_marca->set_id($_POST['marca']);
        		$object_marca->set_categoria_id($_POST['categoria']);
        		$object_marca->set_nome($_POST['nome']);
        		$object_marca->set_url($_POST['url']);
        
        		if (DAO_Marca::Verificar_Marca_Repetida($object_marca)) {
        			DAO_Marca::Atualizar($object_marca);
        		} else {
        			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Marca Nome/URL Já Estão Cadastrados Para Está Categoria</b></div>";
        		}
        	}
        }
        
        private function Alterar_Categoria() {
        	if ($this->Validar_Nome_URL()) {
        		$object_categoria = new Object_Categoria();
        
        		$object_categoria->set_id($_POST['categoria']);
        		$object_categoria->set_nome($_POST['nome']);
        		$object_categoria->set_url($_POST['url']);
        
        		if (DAO_Categoria::Verificar_Categoria_Repetida($object_categoria)) {
        			DAO_Categoria::Atualizar($object_categoria);
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
        
        public function Retornar_Categoria() {
        	$object_categoria = $this->Buscar_Categoria_Por_Id($_GET['categoria']);
        	
        	if (!empty($object_categoria)) {
        		$categoria = array();
        		
        		$categoria['nome'] = $object_categoria->get_nome();
        		$categoria['url'] = $object_categoria->get_url();
        		
        		echo json_encode($categoria);
        	}
        }
        
        public function Retornar_Marca() {
        	$object_marca = $this->Buscar_Marca_Por_Id($_GET['marca']);
        	 
        	if (!empty($object_marca)) {
        		$marca = array();
        
        		$marca['nome'] = $object_marca->get_nome();
        		$marca['url'] = $object_marca->get_url();
        
        		echo json_encode($marca);
        	}
        }
        
        public function Retornar_Modelo() {
        	$object_modelo = $this->Buscar_Modelo_Por_Id($_GET['modelo']);
        
        	if (!empty($object_modelo)) {
        		$modelo = array();
        
        		$modelo['nome'] = $object_modelo->get_nome();
        		$modelo['url'] = $object_modelo->get_url();
        
        		echo json_encode($modelo);
        	}
        }
        
        public function Retornar_Versao() {
        	$object_versao = $this->Buscar_Versao_Por_Id($_GET['versao']);
        
        	if (!empty($object_versao)) {
        		$versao = array();
        
        		$versao['nome'] = $object_versao->get_nome();
        		$versao['url'] = $object_versao->get_url();
        
        		echo json_encode($versao);
        	}
        }
        
        public function Retornar_Categorias() {
        	View_Alterar::Carregar_Categorias(DAO_Categoria::BuscarTodos());
        }
        
        public function Retornar_Marcas_Por_Categoria() {
        	View_Alterar::Carregar_Marcas($this->Buscar_Marca_Por_Id_Categoria($_GET['categoria']));
        }
        
        public function Retornar_Modelos_Por_Marca() {
        	View_Alterar::Carregar_Modelos($this->Buscar_Modelo_Por_Id_Marca($_GET['marca']));
        }
        
        public function Retornar_Versoes_Por_Modelo() {
        	View_Alterar::Carregar_Versoes($this->Buscar_Versoes_Por_Id_Modelo($_GET['modelo']));
        }
        
        private function Buscar_Marca_Por_Id_Categoria($categoria) {
        	if (!empty($categoria)) {
        		return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Modelo_Por_Id_Marca($marca) {
        	if (!empty($marca)) {
        		return DAO_Modelo::Buscar_Por_ID_Marca($marca);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Versoes_Por_Id_Modelo($modelo) {
        	if (!empty($modelo)) {
        		return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Categoria_Por_Id($categoria) {
        	if (!empty($categoria)) {
        		return DAO_Categoria::Buscar_Nome_URL_Por_ID($categoria);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Marca_Por_Id($marca) {
        	if (!empty($marca)) {
        		return DAO_Marca::Buscar_Nome_URL_Por_ID($marca);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Modelo_Por_Id($modelo) {
        	if (!empty($modelo)) {
        		return DAO_Modelo::Buscar_Nome_URL_Por_ID($modelo);
        	} else {
        		return null;
        	}
        }
        
        private function Buscar_Versao_Por_Id($versao) {
        	if (!empty($versao)) {
        		return DAO_Versao::Buscar_Nome_URL_Por_ID($versao);
        	} else {
        		return null;
        	}
        }
    }
?>