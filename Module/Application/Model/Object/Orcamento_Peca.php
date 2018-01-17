<?php
namespace Module\Application\Model\Object;

    class Orcamento_Peca
    {
        
        private $orcamento_id;
        private $peca_id;
        
        function __constructor()
        {
            
        }
        
        public function set_orcamento_id(int $orcamento_id) : void
        {
            $this->orcamento_id = $orcamento_id;
        }
        
        public function get_orcamento_id() : ?int
        {
            return $this->orcamento_id;
        }
        
        public function set_peca_id(int $peca_id) : void
        {
            $this->peca_id = $peca_id;
        }
        
        public function get_peca_id() : ?int
        {
            return $this->peca_id;
        }
    }
