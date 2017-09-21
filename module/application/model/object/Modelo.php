<?php
namespace module\application\model\object;

    class Modelo {
    	
    	private $id;
		private $marca_id;
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
		
		public function set_marca_id(int $marca_id) : void {
			$this->marca_id = $marca_id;
		}
		
		public function get_marca_id() : ?int {
			return $this->marca_id;
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