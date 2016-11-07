<?php
namespace application\model\object;
	
	require_once RAIZ.'/application/model/object/foto_peca.php';
	require_once RAIZ.'/application/model/object/status_peca.php';
	require_once RAIZ.'/application/model/object/endereco.php';
	require_once RAIZ.'/application/model/object/dados_usuario.php';
	
	use application\model\object\Foto_Peca as Object_Foto_Peca;
	use application\model\object\Status_Peca as Object_Status_Peca;
	use application\model\object\Endereco as Object_Endereco;
	use application\model\object\Dados_Usuario as Object_Dados_Usuario;
	
    class Peca {
    	private $id;
		private $dados_usuario;
		private $nome;
		private $fabricante;
		private $endereco;
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
		
		public function set_dados_usuario(Object_Dados_Usuario $dados_usuario) {
			$this->dados_usuario = $dados_usuario;
		}
		
		public function get_dados_usuario() {
			return $this->dados_usuario;
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
		
		public function set_endereco(Object_Endereco $endereco) {
			$this->endereco = $endereco;
		}
		
		public function get_endereco() {
			return $this->endereco;
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
		
		public function set_fotos(array $fotos) {
			foreach ($fotos as $foto) {
				$this->set_foto($foto);
			}
		}
		
		public function set_foto(Object_Foto_Peca $foto) {
			$this->fotos[$foto->get_numero()] = $foto;
		}
		
		public function get_fotos() {
			return $this->fotos;
		}
		
		public function get_foto($numero) {
			return $this->fotos[$numero];
		}
    }
?>