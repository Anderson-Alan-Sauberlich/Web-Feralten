<?php
namespace application\model\object;

    class Cidade {
    	private $id;
		private $estado_id;
		private $nome;
		
		function __constructor() {
			
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_estado_id($estado_id) {
			$this->estado_id = $estado_id;
		}
		
		public function get_estado_id() {
			return $this->estado_id;
		}
		
		public function set_nome($nome) {
			$this->nome = $nome;
		}
		
		public function get_nome() {
			return $this->nome;
		}
    }
?>