<?php
namespace application\model\object;
    
    class Usuario {
    	private $id;
        private $nome;
        private $email;
        private $senha;
		private $ultimo_login;
		private $token;
		
		function __constructor() {
			
		}
		
		public function set_id($id) {
            $this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_nome($nome) {
            $this->nome = $nome;
		}
		
		public function get_nome() {
			return $this->nome;
		}
		
		public function set_email($email) {
            $this->email = $email;
		}
		
		public function get_email() {
			return $this->email;
		}
		
		public function set_senha($senha) {
            $this->senha = $senha;
		}
		
		public function get_senha() {
			return $this->senha;
		}
		
		public function set_ultimo_login($ultimo_login) {
            $this->ultimo_login = $ultimo_login;
		}
		
		public function get_ultimo_login() {
			return $this->ultimo_login;
		}
		
		public function set_token($token) {
            $this->token = $token;
		}
		
		public function get_token() {
			return $this->token;
		}
    }
?>