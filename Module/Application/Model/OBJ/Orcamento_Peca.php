<?php
namespace Module\Application\Model\OBJ;

    use Module\Application\Model\OBJ\Orcamento as OBJ_Orcamento;
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;

    class Orcamento_Peca
    {
        private $obj_orcamento;
        private $obj_peca;
        
        function __constructor()
        {
            
        }
        
        public function set_orcamento_id(int $orcamento_id) : void
        {
            if (!$this->obj_orcamento instanceof OBJ_Orcamento) {
                $this->obj_orcamento = new OBJ_Orcamento();
            }
            
            $this->obj_orcamento->set_id($orcamento_id);
        }
        
        public function get_orcamento_id() : ?int
        {
            if ($this->obj_orcamento instanceof OBJ_Orcamento) {
                return $this->obj_orcamento->get_id();
            } else {
                return null;
            }
        }
        
        public function set_peca_id(int $peca_id) : void
        {
            if (!$this->obj_peca instanceof OBJ_Peca) {
                $this->obj_peca = new OBJ_Peca();
            }
            
            $this->obj_peca->set_id($peca_id);
        }
        
        public function get_peca_id() : ?int
        {
            if ($this->obj_peca instanceof OBJ_Peca) {
                return $this->obj_peca->get_id();
            } else {
                return null;
            }
        }
        
        public function set_orcamento(OBJ_Orcamento $obj_orcamento) : void
        {
            $this->obj_orcamento = $obj_orcamento;
        }
        
        public function get_orcamento() : ?OBJ_Orcamento
        {
            return $this->obj_orcamento;
        }
        
        public function set_peca(OBJ_Peca $obj_peca) : void
        {
            $this->obj_peca = $obj_peca;
        }
        
        public function get_peca() : ?OBJ_Peca
        {
            return $this->obj_peca;
        }
    }
