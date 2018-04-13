<?php
namespace Module\Application\Model\OBJ;
    
    use Module\Application\Model\OBJ\Status_Fatura as OBJ_Status_Fatura;
    
    class Fatura
    {
        private $id;
        private $entidade_id;
        private $valor_total;
        private $obj_status;
        private $data_emissao;
        private $data_vencimento;
        private $data_fechamento;
        private $servicos = [];
        
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
        
        public function set_entidade_id(int $entidade_id) : void
        {
            $this->entidade_id = $entidade_id;
        }
        
        public function get_entidade_id() : ?int
        {
            return $this->entidade_id;
        }
        
        public function set_valor_total(float $valor_total) : void
        {
            $this->valor_total = $valor_total;
        }
        
        public function get_valor_total() : ?float
        {
            return $this->valor_total;
        }
        
        public function set_obj_status(OBJ_Status_Fatura $obj_status) : void
        {
            $this->obj_status = $obj_status;
        }
        
        public function get_obj_status() : ?OBJ_Status_Fatura
        {
            return $this->obj_status;
        }
        
        public function set_data_emissao(string $data_emissao) : void
        {
            $this->data_emissao = $data_emissao;
        }
        
        public function get_data_emissao() : ?string
        {
            return $this->data_emissao;
        }
        
        public function set_data_vencimento(string $data_vencimento) : void
        {
            $this->data_vencimento = $data_vencimento;
        }
        
        public function get_data_vencimento() : ?string
        {
            return $this->data_vencimento;
        }
        
        public function set_data_fechamento(string $data_fechamento) : void
        {
            $this->data_fechamento = $data_fechamento;
        }
        
        public function get_data_fechamento() : ?string
        {
            return $this->data_fechamento;
        }
        
        public function set_servicos(?array $servicos) : void
        {
            $this->servicos = $servicos;
        }
        
        public function get_servicos() : ?array
        {
            return $this->servicos;
        }
    }
