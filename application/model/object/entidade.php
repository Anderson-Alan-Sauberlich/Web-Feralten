<?php
namespace application\model\object;
	
	require_once RAIZ.'/application/model/object/endereco.php';
	
	use application\model\object\Endereco as Object_Endereco;

	class Entidade {
		
		private $id;
		private $usuario_id;
        private $status_id;
        private $cpf_cnpj;
        private $nome_comercial;
        private $imagem;
		private $site;
        private $data;
        private $enderecos = array();
		
		function __constructor() {
			
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : ?int {
			return $this->id;
		}
		
		public function set_usuario_id(int $usuario_id) : void {
			$this->usuario_id = $usuario_id;
		}
		
		public function get_usuario_id() : ?int {
			return $this->usuario_id;
		}
        
        public function set_status_id(int $status_id) : void {
            $this->status_id = $status_id;
        }
        
        public function get_status_id() : ?int {
            return $this->status_id;
        }
        
        public function set_cpf_cnpj(string $cpf_cnpj) : void {
            $this->cpf_cnpj = $cpf_cnpj;
        }
        
        public function get_cpf_cnpj() : ?string {
            return $this->cpf_cnpj;
        }
        
        public function set_nome_comercial(?string $nome_comercial = null) : void {
            $this->nome_comercial = $nome_comercial;
        }
        
        public function get_nome_comercial() : ?string {
            return $this->nome_comercial;
        }
        
        public function set_imagem(?string $imagem = null) : void {
            $this->imagem = $imagem;
        }
        
        public function get_imagem() : ?string {
            return $this->imagem;
        }
		
        public function set_site(?string $site = null) : void {
            $this->site = $site;
        }
        
        public function get_site() : ?string {
            return $this->site;
        }
        
        public function set_data(string $data) : void {
            $this->data = $data;
        }
        
        public function get_data() : ?string {
            return $this->data;
        }
        
        public function set_enderecos(array $enderecos) : void {
        	foreach ($enderecos as $endereco) {
        		$this->set_endereco($endereco);
        	}
        }
        
        public function set_endereco(Object_Endereco $endereco) : void {
        	$this->enderecos[] = $endereco;
        }
        
        public function get_enderecos() : ?array {
        	return $this->enderecos;
        }
	}
?>