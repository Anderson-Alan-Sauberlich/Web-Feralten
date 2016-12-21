<?php
namespace application\model\object;

    class Estado {
    	private $id;
		private $uf;
		private $nome;
		
		function __constructor() {
			
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : ?int {
			return $this->id;
		}
		
		public function set_uf(string $uf) : void {
			$this->uf = $uf;
		}
		
		public function get_uf() : ?string {
			return $this->uf;
		}
		
		public function set_nome(string $nome) : void {
			$this->nome = $nome;
		}
		
		public function get_nome() : ?string {
			return $this->nome;
		}
    }
?>