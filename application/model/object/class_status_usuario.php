<?php
namespace application\model\object;

    class Status_Usuario {
    	private $id;
		private $nome;
		private $descricao;
		
		function __constructor() {
			
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_nome($nome) {
			$this->nome = $nome;
		}
		
		public function get_nome() {
			return $this->nome;
		}
		
		public function set_descricao($descricao) {
			$this->descricao = $descricao;
		}
		
		public function get_descricao() {
			return $this->descricao;
		}
    }
?>