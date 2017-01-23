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
		
		public function set_id(int $id) : void {
            $this->id = $id;
		}
		
		public function get_id() : ?int {
			return $this->id;
		}
		
		public function set_nome(string $nome) : void {
            $this->nome = $nome;
		}
		
		public function get_nome() : ?string {
			return $this->nome;
		}
		
		public function set_email(string $email) : void {
            $this->email = $email;
		}
		
		public function get_email() : ?string {
			return $this->email;
		}
		
		public function set_senha(string $senha) : void {
            $this->senha = $senha;
		}
		
		public function get_senha() : ?string {
			return $this->senha;
		}
		
		public function set_ultimo_login(string $ultimo_login) : void {
            $this->ultimo_login = $ultimo_login;
		}
		
		public function get_ultimo_login() : ?string {
			return $this->ultimo_login;
		}
		
		public function set_token(?string $token = null) : void {
            $this->token = $token;
		}
		
		public function get_token() : ?string {
			return $this->token;
		}
    }
?>