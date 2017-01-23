<?php
namespace application\model\object;

    class Foto_Peca {
    	
    	private $id;
		private $peca_id;
		private $endereco;
		private $numero;
		
		function __constructor() {
			
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : ?int {
			return $this->id;
		}
		
		public function set_peca_id(int $peca_id) : void {
			$this->peca_id = $peca_id;
		}
		
		public function get_peca_id() : ?int {
			return $this->peca_id;
		}
		
		public function set_endereco(string $endereco) : void {
			$this->endereco = $endereco;
		}
		
		public function get_endereco() : ?string {
			return $this->endereco;
		}
		
		public function set_numero(int $numero) : void {
			$this->numero = $numero;
		}
		
		public function get_numero() : ?int {
			return $this->numero;
		}
    }
?>