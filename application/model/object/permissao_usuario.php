<?php
namespace application\model\object;

    class Permissao_Usuario {
    	
    	private $id;
		private $funcionalidade;
		
		function __constructor() {
			
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : ?int {
			return $this->id;
		}
		
		public function set_funcionalidade(string $funcionalidade) : void {
			$this->funcionalidade = $funcionalidade;
		}
		
		public function get_funcionalidade() : ?string {
			return $this->funcionalidade;
		}
    }
?>