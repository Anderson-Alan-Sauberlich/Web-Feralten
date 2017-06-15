<?php
namespace application\controller\include_page\menu;
	
	use application\model\common\util\Validador;
	use application\view\src\include_page\menu\Filtro as View_Filtro;
	use application\model\dao\Cidade as DAO_Cidade;
	use application\model\dao\Estado as DAO_Estado;
	use application\model\object\Cidade as Object_Cidade;
	use application\model\object\Estado as Object_Estado;
	use application\model\dao\Status_Peca as DAO_Status_Peca;
	use application\model\object\Status_Peca as Object_Status_Peca;
	use \Exception;
	
	class Filtro {
		
	    function __construct() {
	        
		}
		
		private $estado;
		private $cidade;
		private $status;
		private $ordem_preco;
		private $ordem_data;
		
		public function set_estado($estado) : void {
			try {
				$this->estado = Validador::Estado()::validar_id($estado);
			} catch (Exception $e) {
				$this->estado = Validador::Estado()::filtrar_id($estado);
			}
		}
		
		public function set_cidade($cidade) : void {
			try {
				$this->cidade = Validador::Cidade()::validar_id($cidade);
			} catch (Exception $e) {
				$this->cidade = Validador::Cidade()::filtrar_id($cidade);
			}
		}
		
		public function set_estado_uf($estado_uf) : void {
			try {
				$this->set_estado(DAO_Estado::Buscar_Id_Por_Uf(Validador::Estado()::validar_uf($estado_uf)));
			} catch (Exception $e) {
				$this->estado = null;
			}
		}
		
		public function set_cidade_url($cidade_url) : void {
			try {
				if ($cidade_url != 'estoque') {
					$this->set_cidade(DAO_Cidade::Buscar_Id_Por_Url(Validador::Cidade()::validar_url($cidade_url)));
				}
			} catch (Exception $e) {
				$this->cidade = null;
			}
		}
		
		public function set_ordem_preco($ordem_preco) : void {
			try {
				$this->ordem_preco = Validador::Peca()::validar_ordem_preco($ordem_preco);
			} catch (Exception $e) {
				$this->ordem_preco = null;
			}
		}
		
		public function set_ordem_data($ordem_data) : void {
			try {
				$this->ordem_data = Validador::Peca()::validar_ordem_data($ordem_data);
			} catch (Exception $e) {
				$this->ordem_data = null;
			}
		}
		
		public function set_status($status) : void {
			try {
				$this->status = Validador::Peca()::validar_status($status);
			} catch (Exception $e) {
				$this->status = null;
			}
		}
		
		public function get_estado() : ?int {
			return $this->estado;
		}
		
		public function get_cidade() : ?int {
			return $this->cidade;
		}
		
		public function get_status() : ?int {
			return $this->status;
		}
		
		public function get_object_estado() : ?Object_Estado {
			$object_estado = new Object_Estado();
			
			$object_estado->set_id($this->estado);
			
			if (!empty($this->estado)) {
				return $object_estado;
			} else {
				return null;
			}
		}
		
		public function get_object_cidade() : ?Object_Cidade {
			$object_cidade = new Object_Cidade();
			
			$object_cidade->set_id($this->cidade);
			
			if (!empty($this->cidade)) {
				return $object_cidade;
			} else {
				return null;
			}
		}
		
		public function get_object_status() : ?Object_Status_Peca {
			$object_status_peca = new Object_Status_Peca();
			
			$object_status_peca->set_id($this->status);
			
			if (!empty($this->status)) {
				return $object_status_peca;
			} else {
				return null;
			}
		}
		
		
		public function get_form() : ?array {
			$form_filtro = array();
			
			$form_filtro['estado'] = $this->estado;
			$form_filtro['cidade'] = $this->cidade;
			$form_filtro['ordem_preco'] = $this->ordem_preco;
			$form_filtro['ordem_data'] = $this->ordem_data;
			$form_filtro['status'] = $this->status;
			
			return $form_filtro;
		}
		
		public function Retornar_Cidades_Por_Estado() : void {
			if (!empty($this->estado)) {
				View_Filtro::Mostrar_Cidades($this->estado);
			}
		}
		
		public static function Buscar_Estados() {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidade_Por_Estado(int $id_estado) {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
		
		public static function Buscar_Status_Pecas() {
			return DAO_Status_Peca::BuscarTodos();
		}
	}
?>