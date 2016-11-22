<?php
namespace application\model\object;
	
	require_once RAIZ.'/application/model/object/endereco.php';
	
	use application\model\object\Endereco as Object_Endereco;

	class Dados_Usuario {
		private $usuario_id;
        private $status_id;
        private $cpf_cnpj;
        private $nome_fantasia;
        private $imagem;
		private $site;
        private $data;
        private $telefone1;
        private $telefone2;
        private $email;
        private $enderecos = array();
		
		function __constructor() {
			
		}
		
		public function set_usuario_id(int $usuario_id) : void {
			$this->usuario_id = $usuario_id;
		}
		
		public function get_usuario_id() : int {
			return $this->usuario_id;
		}
        
        public function set_status_id(int $status_id) : void {
            $this->status_id = $status_id;
        }
        
        public function get_status_id() : int {
            return $this->status_id;
        }
        
        public function set_cpf_cnpj(string $cpf_cnpj) : void {
            $this->cpf_cnpj = $cpf_cnpj;
        }
        
        public function get_cpf_cnpj() : string {
            return $this->cpf_cnpj;
        }
        
        public function set_nome_fantasia(?string $nome_fantasia = null) : void {
            $this->nome_fantasia = $nome_fantasia;
        }
        
        public function get_nome_fantasia() : ?string {
            return $this->nome_fantasia;
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
        
        public function get_data() : string {
            return $this->data;
        }
        
        public function set_telefone1(string $telefone1) : void {
        	$this->telefone1 = $telefone1;
        }
        
        public function get_telefone1() : string {
        	return $this->telefone1;
        }
        
        public function set_telefone2(?string $telefone2 = null) : void {
        	$this->telefone2 = $telefone2;
        }
        
        public function get_telefone2() : ?string {
        	return $this->telefone2;
        }
        
        public function set_email(?string $email = null) : void {
        	$this->email = $email;
        }
        
        public function get_email() : ?string {
        	return $this->email;
        }
        
        public function set_enderecos(array $enderecos) : void {
        	foreach ($enderecos as $endereco) {
        		$this->set_endereco($endereco);
        	}
        }
        
        public function set_endereco(Object_Endereco $endereco) : void {
        	$this->enderecos[] = $endereco;
        }
        
        public function get_enderecos() : array {
        	return $this->enderecos;
        }
	}
?>