<?php
namespace Module\Application\Model\OBJ;

    class Plano
    {
        private $id;
        private $valor_mensal;
        private $valor_anual;
        private $limite_pecas;
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
        
        public function set_valor_mensal(float $valor_mensal) : void
        {
            $this->valor_mensal = $valor_mensal;
        }
        
        public function get_valor_mensal() : ?float
        {
            return $this->valor_mensal;
        }
        
        public function set_valor_anual(float $valor_anual) : void
        {
            $this->valor_anual = $valor_anual;
        }
        
        public function get_valor_anual() : ?float
        {
            return $this->valor_anual;
        }
        
        public function set_limite_pecas(int $limite_pecas) : void
        {
            $this->limite_pecas = $limite_pecas;
        }
        
        public function get_limite_pecas() : ?int
        {
            return $this->limite_pecas;
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
