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
	require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/deletar.php';
	
	use application\model\dao\Categoria as DAO_Categoria;
	use application\model\dao\Marca as DAO_Marca;
	use application\model\dao\Modelo as DAO_Modelo;
	use application\model\dao\Versao as DAO_Versao;
	use application\model\object\Versao as Object_Versao;
	use application\model\object\Modelo as Object_Modelo;
	use application\model\object\Marca as Object_Marca;
	use application\model\object\Categoria as Object_Categoria;
	use application\view\src\admin\controle\base_de_conhecimento\cmmv\Deletar as View_Deletar;
	
    class Deletar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Deletar();
        	
        	$view->set_categorias(DAO_Categoria::BuscarTodos());
        	
        	$view->Executar();
        }
        
        public function Deletar_CMMV() {
        	if (!empty($_POST['versao'])) {
        		$this->Deletar_Versao();
        	} else if (!empty($_POST['modelo'])) {
        		$this->Deletar_Modelo();
        	} else if (!empty($_POST['marca'])) {
        		$this->Deletar_Marca();
        	} else if (!empty($_POST['categoria'])) {
        		$this->Deletar_Categoria();
        	}
        }
        
        private function Deletar_Versao() {
        	if (!DAO_Versao::Deletar($_POST['versao'])) {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Deletar Versão Falhou</b></div>";
        	}
        }
        
        private function Deletar_Modelo() {
        	if (!DAO_Modelo::Deletar($_POST['modelo'])) {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Deletar Modelo Falhou</b></div>";
        	}
        }
        
        private function Deletar_Marca() {
        	if (!DAO_Marca::Deletar($_POST['marca'])) {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Deletar Marca Falhou</b></div>";
        	}
        }
        
        private function Deletar_Categoria() {
        	if (!DAO_Categoria::Deletar($_POST['categoria'])) {
        		echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Deletar Categoria Falhou</b></div>";
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
        
        public function Retornar_Marcas_Por_Categoria() {
        	View_Deletar::Carregar_Marcas($this->Buscar_Marca_Por_Id_Categoria($_GET['categoria']));
        }
        
        public function Retornar_Modelos_Por_Marca() {
        	View_Deletar::Carregar_Modelos($this->Buscar_Modelo_Por_Id_Marca($_GET['marca']));
        }
        
        public function Retornar_Versoes_Por_Modelo() {
        	View_Deletar::Carregar_Versoes($this->Buscar_Versoes_Por_Id_Modelo($_GET['modelo']));
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