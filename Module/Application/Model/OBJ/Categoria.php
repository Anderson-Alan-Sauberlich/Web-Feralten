<?php
namespace Module\Application\Model\OBJ;

    class Categoria
    {
        private $id;
        private $nome;
        private $url;
        
        function __constructor()
        {
            
        }
        
        public function set_id($id) : void
        {
            $this->id = $id;
        }
        
        public function get_id() : ?int
        {
            return $this->id;
        }
        
        public function set_nome(string $nome) : void
        {
            $this->nome = $nome;
        }
        
        public function get_nome() : ?string
        {
            return $this->nome;
        }
        
        public function set_url(string $url) : void
        {
            $this->url = $url;
        }
        
        public function get_url() : ?string
        {
            return $this->url;
        }
    }
