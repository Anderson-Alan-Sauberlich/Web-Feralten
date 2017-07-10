<?php
namespace application\model\object;
	
	use application\model\object\Foto_Peca as Object_Foto_Peca;
	use application\model\object\Status_Peca as Object_Status_Peca;
	use application\model\object\Estado_Peca as Object_Estado_Peca;
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
		private $estado;
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
		
		public function set_estado(?Object_Estado_Peca $estado = null) : void {
		    $this->estado = $estado;
		}
		
		public function get_estado() : ?Object_estado_Peca {
		    return $this->estado;
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
		
		public function get_foto(int $numero) : ?Object_Foto_Peca {
			if (isset($this->fotos[$numero])) {
				return $this->fotos[$numero];
			} else {
				return null;
			}
		}
		
		public function set_preferencia_entrega(?int $preferencia_entrega = null) : void {
			$this->preferencia_entrega = $preferencia_entrega;
		}
		
		public function get_preferencia_entrega() : ?int {
			return $this->preferencia_entrega;
		}
		
		public function set_preferencias_entrega(?array $preferencais_entrega) : void {
			if (!empty($preferencais_entrega)) {
				$valor = 0;
				
				foreach ($preferencais_entrega as $preferencia_entrega) {
					if (filter_var($preferencia_entrega, FILTER_VALIDATE_INT)) {
						$valor += $preferencia_entrega;
					}
				}
				
				if (!empty($valor) AND filter_var($valor, FILTER_VALIDATE_INT) AND $valor > 0) {
					$this->preferencia_entrega = $valor;
				}
			}
		}
		
		public static function get_preferencias_entrega(?int $preferencia_entrega = null) : ?array {
			$preferencais_entrega = array();
			
			if (!empty($preferencia_entrega)) {
				if ($preferencia_entrega == 1) {
					$preferencais_entrega[] = 1;
				} else if ($preferencia_entrega == 2) {
					$preferencais_entrega[] = 2;
				} else if ($preferencia_entrega == 3) {
					$preferencais_entrega[] = 1;
					$preferencais_entrega[] = 2;
				} else if ($preferencia_entrega == 4) {
					$preferencais_entrega[] = 4;
				} else if ($preferencia_entrega == 5) {
					$preferencais_entrega[] = 4;
					$preferencais_entrega[] = 1;
				} else if ($preferencia_entrega == 6) {
					$preferencais_entrega[] = 4;
					$preferencais_entrega[] = 2;
				} else if ($preferencia_entrega == 7) {
					$preferencais_entrega[] = 1;
					$preferencais_entrega[] = 2;
					$preferencais_entrega[] = 4;
				} else if ($preferencia_entrega == 8) {
					$preferencais_entrega[] = 8;
				} else if ($preferencia_entrega == 9) {
					$preferencais_entrega[] = 8;
					$preferencais_entrega[] = 1;
				} else if ($preferencia_entrega == 10) {
					$preferencais_entrega[] = 8;
					$preferencais_entrega[] = 2;
				} else if ($preferencia_entrega == 11) {
					$preferencais_entrega[] = 8;
					$preferencais_entrega[] = 1;
					$preferencais_entrega[] = 2;
				} else if ($preferencia_entrega == 12) {
					$preferencais_entrega[] = 8;
					$preferencais_entrega[] = 4;
				} else if ($preferencia_entrega == 13) {
					$preferencais_entrega[] = 8;
					$preferencais_entrega[] = 1;
					$preferencais_entrega[] = 4;
				} else if ($preferencia_entrega == 14) {
					$preferencais_entrega[] = 8;
					$preferencais_entrega[] = 4;
					$preferencais_entrega[] = 2;
				} else if ($preferencia_entrega == 15) {
					$preferencais_entrega[] = 8;
					$preferencais_entrega[] = 1;
					$preferencais_entrega[] = 2;
					$preferencais_entrega[] = 4;
				}
			}
			
			return $preferencais_entrega;
		}
    }
?>