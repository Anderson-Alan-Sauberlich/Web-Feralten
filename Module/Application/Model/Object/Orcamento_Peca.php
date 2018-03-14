<?php
namespace Module\Application\Model\Object;

    use Module\Application\Model\Object\Orcamento as Object_Orcamento;
    use Module\Application\Model\Object\Peca as Object_Peca;

    class Orcamento_Peca
    {
        private $obj_orcamento;
        private $obj_peca;
        
        function __constructor()
        {
            
        }
        
        public function set_orcamento_id(int $orcamento_id) : void
        {
            if (!$this->obj_orcamento instanceof Object_Orcamento) {
                $this->obj_orcamento = new Object_Orcamento();
            }
            
            $this->obj_orcamento->set_id($orcamento_id);
        }
        
        public function get_orcamento_id() : ?int
        {
            if ($this->obj_orcamento instanceof Object_Orcamento) {
                return $this->obj_orcamento->get_id();
            } else {
                return null;
            }
        }
        
        public function set_peca_id(int $peca_id) : void
        {
            if (!$this->obj_peca instanceof Object_Peca) {
                $this->obj_peca = new Object_Peca();
            }
            
            $this->obj_peca->set_id($peca_id);
        }
        
        public function get_peca_id() : ?int
        {
            if ($this->obj_peca instanceof Object_Peca) {
                return $this->obj_peca->get_id();
            } else {
                return null;
            }
        }
        
        public function set_orcamento(Object_Orcamento $obj_orcamento) : void
        {
            $this->obj_orcamento = $obj_orcamento;
        }
        
        public function get_orcamento() : ?Object_Orcamento
        {
            return $this->obj_orcamento;
        }
        
        public function set_peca(Object_Peca $obj_peca) : void
        {
            $this->obj_peca = $obj_peca;
        }
        
        public function get_peca() : ?Object_Peca
        {
            return $this->obj_peca;
        }
    }
