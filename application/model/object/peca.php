<?php
namespace application\model\object;
	
	require_once RAIZ.'/application/model/object/foto_peca.php';
	require_once RAIZ.'/application/model/object/status_peca.php';
	
	use application\model\object\Foto_Peca as Object_Foto_Peca;
	use application\model\object\Status_Peca as Object_Status_Peca;
	
    class Peca {
    	private $id;
		private $usuario_id;
		private $nome;
		private $fabricante;
		private $endereco_id;
		private $contato_id;
		private $preco;
		private $descricao;
		private $data_anuncio;
		private $serie;
		private $prioridade;
		private $status;
		private $fotos = array();
		
		function __constructor() {
			
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_usuario_id($usuario_id) {
			$this->usuario_id = $usuario_id;
		}
		
		public function get_usuario_id() {
			return $this->usuario_id;
		}
		
		public function set_nome($nome) {
			$this->nome = $nome;
		}
		
		public function get_nome() {
			return $this->nome;
		}
		
		public function set_fabricante($fabricante) {
			$this->fabricante = $fabricante;
		}
		
		public function get_fabricante() {
			return $this->fabricante;
		}
		
		public function set_serie($serie) {
			$this->serie = $serie;
		}
		
		public function get_serie() {
			return $this->serie;
		}
		
		public function set_endereco_id($endereco_id) {
			$this->endereco_id = $endereco_id;
		}
		
		public function get_endereco_id() {
			return $this->endereco_id;
		}
		
		public function set_contato_id($contato_id) {
			$this->contato_id = $contato_id;
		}
		
		public function get_contato_id() {
			return $this->contato_id;
		}
		
		public function set_preco($preco) {
			$this->preco = $preco;
		}
		
		public function get_preco() {
			return $this->preco;
		}
		
		public function set_data_anuncio($data_anuncio) {
			$this->data_anuncio = $data_anuncio;
		}
		
		public function get_data_anuncio() {
			return $this->data_anuncio;
		}
		
		public function set_descricao($descricao) {
			$this->descricao = $descricao;
		}
		
		public function get_descricao() {
			return $this->descricao;
		}
		
		public function set_prioridade($prioridade) {
			$this->prioridade = $prioridade;
		}
		
		public function get_prioridade() {
			return $this->prioridade;
		}
		
		public function set_status(Object_Status_Peca $status) {
			$this->status = $status;
		}
		
		public function get_status() {
			return $this->status;
		}
		
		public function set_fotos(Object_Foto_Peca $foto) {
			$this->fotos[] = $foto;
		}
		
		public function get_fotos() {
			return $this->fotos;
		}
    }
?>