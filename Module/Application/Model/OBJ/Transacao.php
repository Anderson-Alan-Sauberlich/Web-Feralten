<?php
namespace Module\Application\Model\OBJ;
    
    class Transacao
    {
        private $id;
        private $fatura_id;
        private $valor;
        private $datahora;
        private $status;
        private $forma_pagamento;
        
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
        
        public function set_datahora(string $datahora) : void
        {
            $this->datahora = $datahora;
        }
        
        public function get_datahora() : ?string
        {
            return $this->datahora;
        }
        
        public function set_status(string $status) : void
        {
            $this->status = $status;
        }
        
        public function get_status() : ?string
        {
            return $this->status;
        }
        
        public function set_forma_pagamento(string $forma_pagamento) : void
        {
            $this->forma_pagamento = $forma_pagamento;
        }
        
        public function get_forma_pagamento() : ?string
        {
            return $this->forma_pagamento;
        }
    }
