<?php
namespace application\model\object;

    class Lista_Pativel {
    	private $peca_id;
		private $categoria_id;
		private $marca_id;
		private $modelo_id;
		private $versao_id;
		private $ano_de;
		private $ano_ate;
		
		function __constructor() {
			
		}
		
		public function set_categoria_id($categoria_id) {
			$this->categoria_id = $categoria_id;
		}
		
		public function get_categoria_id() {
			return $this->categoria_id;
		}
		
		public function set_modelo_id($modelo_id) {
			$this->modelo_id = $modelo_id;
		}
		
		public function get_modelo_id() {
			return $this->modelo_id;
		}
		
		public function set_marca_id($marca_id) {
			$this->marca_id = $marca_id;
		}
		
		public function get_marca_id() {
			return $this->marca_id;
		}
		
		public function set_peca_id($peca_id) {
			$this->peca_id = $peca_id;
		}
		
		public function get_peca_id() {
			return $this->peca_id;
		}
		
		public function set_versao_id($versao_id) {
			$this->versao_id = $versao_id;
		}
		
		public function get_versao_id() {
			return $this->versao_id;
		}
		
		public function set_ano_de($ano_de) {
			$this->ano_de = $ano_de;
		}
		
		public function get_ano_de() {
			return $this->ano_de;
		}
		
		public function set_ano_ate($ano_ate) {
			$this->ano_ate = $ano_ate;
		}
		
		public function get_ano_ate() {
			return $this->ano_ate;
		}
    }
?>