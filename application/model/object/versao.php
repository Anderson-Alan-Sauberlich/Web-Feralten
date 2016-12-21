<?php
namespace application\model\object;

    class Versao {
    	private $id;
		private $modelo_id;
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
		
		public function set_modelo_id(int $modelo_id) : void {
			$this->modelo_id = $modelo_id;
		}
		
		public function get_modelo_id() : ?int {
			return $this->modelo_id;
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