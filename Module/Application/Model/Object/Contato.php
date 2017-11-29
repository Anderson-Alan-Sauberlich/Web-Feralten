<?php
namespace Module\Application\Model\Object;
    
    class Contato
    {
    	
		private $nome;
		private $email;
		private $telefone;
		private $whatsapp;
		private $assunto;
		private $mensagem;
		
		function __constructor()
		{
			
		}
		
		public function set_nome(string $nome) : void
		{
			$this->nome = $nome;
		}
		
		public function get_nome() : ?string
		{
			return $this->nome;
		}
		
		public function set_email(string $email) : void
		{
			$this->email = $email;
		}
		
		public function get_email() : ?string
		{
			return $this->email;
		}
		
		public function set_telefone(string $telefone) : void
		{
		    $this->telefone = $telefone;
		}
		
		public function get_telefone() : ?string
		{
		    return $this->telefone;
		}
		
		public function set_whatsapp(?bool $whatsapp) : void
		{
		    $this->whatsapp = $whatsapp;
		}
		
		public function get_whatsapp() : ?bool
		{
		    return $this->whatsapp;
		}
		
		public function set_assunto(?string $assunto) : void
		{
		    $this->assunto = $assunto;
		}
		
		public function get_assunto() : ?string
		{
		    return $this->assunto;
		}
		
		public function set_mensagem(string $mensagem) : void
		{
		    $this->mensagem = $mensagem;
		}
		
		public function get_mensagem() : ?string
		{
		    return $this->mensagem;
		}
    }
