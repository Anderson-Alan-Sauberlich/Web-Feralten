<?php
namespace Module\Application\Model\OBJ;
    
    use Module\Application\Model\OBJ\Cidade as OBJ_Cidade;
    use Module\Application\Model\OBJ\Estado as OBJ_Estado;
    
    class Endereco
    {
        private $id;
        private $entidade_id;
        private $cidade;
        private $estado;
        private $numero;
        private $cep;
        private $rua;
        private $complemento;
        private $bairro;
        
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
        
        public function set_cidade(OBJ_Cidade $cidade) : void
        {
            $this->cidade = $cidade;
        }
        
        public function get_cidade() : ?OBJ_Cidade
        {
            return $this->cidade;
        }
        
        public function set_estado(OBJ_Estado $estado) : void
        {
            $this->estado = $estado;
        }
        
        public function get_estado() : ?OBJ_Estado
        {
            return $this->estado;
        }
        
        public function set_entidade_id(int $entidade_id) : void
        {
            $this->entidade_id = $entidade_id;
        }
        
        public function get_entidade_id() : ?int
        {
            return $this->entidade_id;
        }
        
        public function set_numero(string $numero) : void
        {
            $this->numero = $numero;
        }
        
        public function get_numero() : ?string
        {
            return $this->numero;
        }
        
        public function set_cep(string $cep) : void
        {
            $this->cep = $cep;
        }
        
        public function get_cep() : ?string
        {
            return $this->cep;
        }
        
        public function set_rua(string $rua) : void
        {
            $this->rua = $rua;
        }
        
        public function get_rua() : ?string
        {
            return $this->rua;
        }
        
        public function set_complemento(?string $complemento = null) : void
        {
            $this->complemento = $complemento;
        }
        
        public function get_complemento() : ?string
        {
            return $this->complemento;
        }
        
        public function set_bairro(string $bairro) : void
        {
            $this->bairro = $bairro;
        }
        
        public function get_bairro() : ?string
        {
            return $this->bairro;
        }
    }
