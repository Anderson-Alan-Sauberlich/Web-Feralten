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
		
		public function set_usuario_id($usuario_id) {
			$this->usuario_id = $usuario_id;
		}
		
		public function get_usuario_id() {
			return $this->usuario_id;
		}
        
        public function set_status_id($status_id) {
            $this->status_id = $status_id;
        }
        
        public function get_status_id() {
            return $this->status_id;
        }
        
        public function set_cpf_cnpj($cpf_cnpj) {
            $this->cpf_cnpj = $cpf_cnpj;
        }
        
        public function get_cpf_cnpj() {
            return $this->cpf_cnpj;
        }
        
        public function set_nome_fantasia($nome_fantasia) {
            $this->nome_fantasia = $nome_fantasia;
        }
        
        public function get_nome_fantasia() {
            return $this->nome_fantasia;
        }
        
        public function set_imagem($imagem) {
            $this->imagem = $imagem;
        }
        
        public function get_imagem() {
            return $this->imagem;
        }
		
        public function set_site($site) {
            $this->site = $site;
        }
        
        public function get_site() {
            return $this->site;
        }
        
        public function set_data($data) {
            $this->data = $data;
        }
        
        public function get_data() {
            return $this->data;
        }
        
        public function set_telefone1($telefone1) {
        	$this->telefone1 = $telefone1;
        }
        
        public function get_telefone1() {
        	return $this->telefone1;
        }
        
        public function set_telefone2($telefone2) {
        	$this->telefone2 = $telefone2;
        }
        
        public function get_telefone2() {
        	return $this->telefone2;
        }
        
        public function set_email($email) {
        	$this->email = $email;
        }
        
        public function get_email() {
        	return $this->email;
        }
        
        public function set_enderecos(array $enderecos) {
        	foreach ($enderecos as $endereco) {
        		$this->set_endereco($endereco);
        	}
        }
        
        public function set_endereco(Object_Endereco $endereco) {
        	$this->enderecos[] = $endereco;
        }
        
        public function get_enderecos() {
        	return $this->enderecos;
        }
	}
?>