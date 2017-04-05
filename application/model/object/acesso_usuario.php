<?php
namespace application\model\object;

    class Acesso_Usuario {
    	
    	private $usuario_id;
		private $entidade_id;
		private $funcionalidade_id;
		private $permissao_id;
		
		function __constructor() {
			
		}
		
		public function set_usuario_id(int $usuario_id) : void {
			$this->usuario_id = $usuario_id;
		}
		
		public function get_usuario_id() : ?int {
			return $this->usuario_id;
		}
		
		public function set_entidade_id(int $entidade_id) : void {
			$this->entidade_id = $entidade_id;
		}
		
		public function get_entidade_id() : ?int {
			return $this->entidade_id;
		}
		
		public function set_funcionalidade_id(int $funcionalidade_id) : void {
			$this->funcionalidade_id = $funcionalidade_id;
		}
		
		public function get_funcionalidade_id() : ?int {
			return $this->funcionalidade_id;
		}
		
		public function set_permissao_id(int $permissao_id) : void {
			$this->permissao_id = $permissao_id;
		}
		
		public function get_permissao_id() : ?int {
			return $this->permissao_id;
		}
    }
?>