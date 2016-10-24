<?php
namespace application\model\object;

    class Foto_Peca {
    	private $id;
		private $peca_id;
		private $endereco;
		private $numero;
		
		function __constructor() {
			
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_peca_id($peca_id) {
			$this->peca_id = $peca_id;
		}
		
		public function get_peca_id() {
			return $this->peca_id;
		}
		
		public function set_endereco($endereco) {
			$this->endereco = $endereco;
		}
		
		public function get_endereco() {
			return $this->endereco;
		}
		
		public function set_numero($numero) {
			$this->numero = $numero;
		}
		
		public function get_numero() {
			return $this->numero;
		}
    }
?>