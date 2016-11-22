<?php
namespace application\model\object;

    class Marca {
    	private $id;
		private $categoria_id;
		private $nome;
		
		function __constructor() {
			
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : int {
			return $this->id;
		}
		
		public function set_categoria_id(int $categoria_id) : void {
			$this->categoria_id = $categoria_id;
		}
		
		public function get_categoria_id() : int {
			return $this->categoria_id;
		}
		
		public function set_nome(string $nome) : void {
			$this->nome = $nome;
		}
		
		public function get_nome() : string {
			return $this->nome;
		}
    }
?>