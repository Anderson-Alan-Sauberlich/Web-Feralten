<?php
namespace application\model\object;
	
	require_once RAIZ.'/application/model/object/foto_peca.php';
	require_once RAIZ.'/application/model/object/status_peca.php';
	require_once RAIZ.'/application/model/object/endereco.php';
	require_once RAIZ.'/application/model/object/entidade.php';
	require_once RAIZ.'/application/model/object/usuario.php';
	
	use application\model\object\Foto_Peca as Object_Foto_Peca;
	use application\model\object\Status_Peca as Object_Status_Peca;
	use application\model\object\Endereco as Object_Endereco;
	use application\model\object\Entidade as Object_Entidade;
	use application\model\object\Usuario as Object_Usuario;
	
    class Peca {
    	
    	private $id;
		private $entidade;
		private $usuario_responsavel;
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
		private $preferencia_entrega;
		
		function __constructor() {
			
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : ?int {
			return $this->id;
		}
		
		public function set_entidade(Object_Entidade $entidade) : void {
			$this->entidade = $entidade;
		}
		
		public function get_entidade() : ?Object_Entidade {
			return $this->entidade;
		}
		
		public function set_responsavel(Object_Usuario $usuario_responsavel) : void {
			$this->usuario_responsavel = $usuario_responsavel;
		}
		
		public function get_responsavel() : ?Object_Usuario {
			return $this->usuario_responsavel;
		}
		
		public function set_nome(string $nome) : void {
			$this->nome = $nome;
		}
		
		public function get_nome() : ?string {
			return $this->nome;
		}
		
		public function set_fabricante(?string $fabricante = null) : void {
			$this->fabricante = $fabricante;
		}
		
		public function get_fabricante() : ?string {
			return $this->fabricante;
		}
		
		public function set_serie(?string $serie = null) : void {
			$this->serie = $serie;
		}
		
		public function get_serie() : ?string {
			return $this->serie;
		}
		
		public function set_endereco(Object_Endereco $endereco) : void {
			$this->endereco = $endereco;
		}
		
		public function get_endereco() : ?Object_Endereco {
			return $this->endereco;
		}
		
		public function set_preco(?float $preco = null) : void {
			$this->preco = $preco;
		}
		
		public function get_preco() : ?float {
			return $this->preco;
		}
		
		public function set_data_anuncio(string $data_anuncio) : void {
			$this->data_anuncio = $data_anuncio;
		}
		
		public function get_data_anuncio() : ?string {
			return $this->data_anuncio;
		}
		
		public function set_descricao(?string $descricao = null) : void {
			$this->descricao = $descricao;
		}
		
		public function get_descricao() : ?string {
			return $this->descricao;
		}
		
		public function set_prioridade(?bool $prioridade = null) : void {
			$this->prioridade = $prioridade;
		}
		
		public function get_prioridade() : ?bool {
			return $this->prioridade;
		}
		
		public function set_status(?Object_Status_Peca $status = null) : void {
			$this->status = $status;
		}
		
		public function get_status() : ?Object_Status_Peca {
			return $this->status;
		}
		
		public function set_fotos(?array $fotos = array()) : void {
			foreach ($fotos as $foto) {
				$this->set_foto($foto);
			}
		}
		
		public function set_foto(?Object_Foto_Peca $foto = null) : void {
			$this->fotos[$foto->get_numero()] = $foto;
		}
		
		public function get_fotos() : ?array {
			return $this->fotos;
		}
		
		public function get_foto($numero) : ?Object_Foto_Peca {
			return $this->fotos[$numero];
		}
		
		public function set_preferencia_entrega(?int $preferencia_entrega= null) : void {
			$this->preferencia_entrega= $preferencia_entrega;
		}
		
		public function get_preferencia_entrega() : ?int {
			return $this->preferencia_entrega;
		}
    }
?>