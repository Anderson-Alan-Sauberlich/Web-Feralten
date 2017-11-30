<?php
namespace Module\Administration\Model\Object;
    
    class Usuario_Admin
    {
        
        private $id;
        private $usuario;
        private $senha;
        private $nome;
        
        function __constructor()
        {
            
        }
        
        public function set_id(int $id) : void
        {
            $this->id = $id;
        }
        
        public function get_id() : ?int
        {
            return $this->id;
        }
        
        public function set_usuario(string $usuario) : void
        {
            $this->usuario = $usuario;
        }
        
        public function get_usuario() : ?string
        {
            return $this->usuario;
        }
        
        public function set_nome(string $nome) : void
        {
            $this->nome = $nome;
        }
        
        public function get_nome() : ?string
        {
            return $this->nome;
        }
        
        public function set_senha(string $senha) : void
        {
            $this->senha = $senha;
        }
        
        public function get_senha() : ?string
        {
            return $this->senha;
        }
    }
