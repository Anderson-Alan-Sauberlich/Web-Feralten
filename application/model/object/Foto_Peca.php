<?php
namespace application\model\object;

    class Foto_Peca {
    	
		private $peca_id;
		private $endereco;
		private $numero;
		private $nome;
		
		function __constructor() {
			
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
		
		public function set_nome(string $nome) : void {
			$this->nome = $nome;
		}
		
		public function get_nome() : ?string {
			return $this->nome;
		}
    }
?>