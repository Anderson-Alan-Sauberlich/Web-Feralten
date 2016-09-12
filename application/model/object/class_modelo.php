<?php
namespace application\model\object;

    class Modelo {
    	private $id;
		private $marca_id;
		private $nome;
				
		function __constructor() {
			
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_marca_id($marca_id) {
			$this->marca_id = $marca_id;
		}
		
		public function get_marca_id() {
			return $this->marca_id;
		}
		
		public function set_nome($nome) {
			$this->nome = $nome;
		}
		
		public function get_nome() {
			return $this->nome;
		}
    }
?>