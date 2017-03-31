<?php
namespace application\model\object;
    
    class Usuario {
    	
    	private $id;
        private $nome;
        private $email;
        private $senha;
		private $ultimo_login;
		private $token;
		private $status_id;
		private $fone1;
		private $fone2;
		private $email_alternativo;
		
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
		
		public function set_status_id(int $status_id) : void {
			$this->status_id = $status_id;
		}
		
		public function get_status_id() : ?int {
			return $this->status_id;
		}
		
		public function set_fone1(string $fone1) : void {
			$this->fone1 = $fone1;
		}
		
		public function get_fone1() : ?string {
			return $this->fone1;
		}
		
		public function set_fone2(string $fone2) : void {
			$this->fone2 = $fone2;
		}
		
		public function get_fone2() : ?string {
			return $this->fone2;
		}
		
		public function set_email_alternativo(string $email_alternativo) : void {
			$this->email_alternativo = $email_alternativo;
		}
		
		public function get_email_alternativo() : ?string {
			return $this->email_alternativo;
		}
    }
?>