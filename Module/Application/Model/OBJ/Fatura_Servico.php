<?php
namespace Module\Application\Model\OBJ;
    
    class Fatura_Servico
    {
        private $id;
        private $fatura_id;
        private $valor;
        private $descricao;
        
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
        
        public function set_fatura_id(int $fatura_id) : void
        {
            $this->fatura_id = $fatura_id;
        }
        
        public function get_fatura_id() : ?int
        {
            return $this->fatura_id;
        }
        
        public function set_valor(float $valor) : void
        {
            $this->valor = $valor;
        }
        
        public function get_valor() : ?float
        {
            return $this->valor;
        }
        
        public function set_descricao(string $descricao) : void
        {
            $this->descricao = $descricao;
        }
        
        public function get_descricao() : ?string
        {
            return $this->descricao;
        }
    }
