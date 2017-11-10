<?php
namespace module\application\model\object;
    
    class Usuario {
    	
    	private $id;
        private $nome;
        private $sobrenome;
        private $email;
        private $senha;
		private $ultimo_login;
		private $token;
		private $status_id;
		private $fone;
		private $fone_alternativo;
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
		
		public function set_sobrenome(string $sobrenome) : void {
		    $this->sobrenome = $sobrenome;
		}
		
		public function get_sobrenome() : ?string {
		    return $this->sobrenome;
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
		
		public function set_fone(string $fone) : void {
			$this->fone = $fone;
		}
		
		public function get_fone() : ?string {
			return $this->fone;
		}
		
		public function set_fone_alternativo(?string $fone_alternativo) : void {
			$this->fone_alternativo = $fone_alternativo;
		}
		
		public function get_fone_alternativo() : ?string {
			return $this->fone_alternativo;
		}
		
		public function set_email_alternativo(?string $email_alternativo) : void {
			$this->email_alternativo = $email_alternativo;
		}
		
		public function get_email_alternativo() : ?string {
			return $this->email_alternativo;
		}
    }
?>