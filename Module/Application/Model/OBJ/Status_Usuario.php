<?php
namespace Module\Application\Model\OBJ;

    class Status_Usuario
    {
        private $id;
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
        
        public function set_nome(string $nome) : void
        {
            $this->nome = $nome;
        }
        
        public function get_nome() : ?string
        {
            return $this->nome;
        }
    }
