<?php
namespace application\model\object;

    class Estado {
    	private $id;
		private $uf;
		private $nome;
		
		function __constructor() {
			
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_uf($uf) {
			$this->uf = $uf;
		}
		
		public function get_uf() {
			return $this->uf;
		}
		
		public function set_nome($nome) {
			$this->nome = $nome;
		}
		
		public function get_nome() {
			return $this->nome;
		}
    }
?>