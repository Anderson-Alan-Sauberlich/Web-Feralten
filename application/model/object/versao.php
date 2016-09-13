<?php
namespace application\model\object;

    class Versao {
    	private $id;
		private $modelo_id;
		private $nome;
		
		function __constructor() {
			
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_modelo_id($modelo_id) {
			$this->modelo_id = $modelo_id;
		}
		
		public function get_modelo_id() {
			return $this->modelo_id;
		}
		
		public function set_nome($nome) {
			$this->nome = $nome;
		}
		
		public function get_nome() {
			return $this->nome;
		}
    }
?>