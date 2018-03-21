<?php
namespace Module\Administration\Model\Object;
    
    class Patrocinador
    {
        private $id;
        private $nome;
        private $imagem;
        private $link;
        private $descricao;
        private $status;
        private $data_inicio;
        private $data_fim;
        
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
        
        public function set_imagem(string $imagem) : void
        {
            $this->imagem = $imagem;
        }
        
        public function get_imagem() : ?string
        {
            return $this->imagem;
        }
        
        public function set_nome(string $nome) : void
        {
            $this->nome = $nome;
        }
        
        public function get_nome() : ?string
        {
            return $this->nome;
        }
        
        public function set_link(string $link) : void
        {
            $this->link = $link;
        }
        
        public function get_link() : ?string
        {
            return $this->link;
        }
        
        public function set_descricao(string $descricao) : void
        {
            $this->descricao = $descricao;
        }
        
        public function get_descricao() : ?string
        {
            return $this->descricao;
        }
        
        public function set_status(bool $status) : void
        {
            $this->status = $status;
        }
        
        public function get_status() : ?bool
        {
            return $this->status;
        }
        
        public function set_data_inicio(string $data_inicio) : void
        {
            $this->data_inicio = $data_inicio;
        }
        
        public function get_data_inicio() : ?string
        {
            return $this->data_inicio;
        }
        
        public function set_data_fim(string $data_fim) : void
        {
            $this->data_fim = $data_fim;
        }
        
        public function get_data_fim() : ?string
        {
            return $this->data_fim;
        }
    }
