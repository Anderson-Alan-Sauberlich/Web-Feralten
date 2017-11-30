<?php
namespace Module\Application\Model\Object;

    class Marca
    {
        
        private $id;
        private $categoria_id;
        private $nome;
        private $url;
        
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
        
        public function set_categoria_id(int $categoria_id) : void
        {
            $this->categoria_id = $categoria_id;
        }
        
        public function get_categoria_id() : ?int
        {
            return $this->categoria_id;
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
