<?php
namespace application\model\object;

    class Cidade {
    	
    	private $id;
		private $estado_id;
		private $nome;
		private $url;
		
		function __constructor() {
			
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : ?int {
			return $this->id;
		}
		
		public function set_estado_id(int $estado_id) : void {
			$this->estado_id = $estado_id;
		}
		
		public function get_estado_id() : ?int {
			return $this->estado_id;
		}
		
		public function set_nome(string $nome) : void {
			$this->nome = $nome;
		}
		
		public function get_nome() : ?string {
			return $this->nome;
		}
		
		public function set_url(string $url) : void {
			$this->url = $url;
		}
		
		public function get_url() : ?string {
			return $this->url;
		}
    }
?>