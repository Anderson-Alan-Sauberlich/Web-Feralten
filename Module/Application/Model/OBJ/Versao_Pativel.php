<?php
namespace Module\Application\Model\OBJ;
    
    use Module\Application\Model\OBJ\Versao as OBJ_Versao;
    
    class Versao_Pativel
    {
        private $peca_id;
        private $obj_versao;
        private $ano_de;
        private $ano_ate;
        private $anos = array();
        private $ano_id;
        
        function __constructor()
        {
            
        }
        
        public function set_peca_id(int $peca_id) : void
        {
            $this->peca_id = $peca_id;
        }
        
        public function get_peca_id() : ?int
        {
            return $this->peca_id;
        }
        
        public function set_obj_versao(OBJ_Versao $obj_versao) : void
        {
            $this->obj_versao = $obj_versao;
        }
        
        public function get_obj_versao() : ?OBJ_Versao
        {
            return $this->obj_versao;
        }
        
        public function set_ano(?int $ano = null) : void
        {
            $this->anos[] = $ano;
        }
        
        public function set_anos(?array $anos = null) : void
        {
            $this->anos = $anos;
        }
        
        public function get_anos() : ?array
        {
            return $this->anos;
        }
        
        public function set_ano_de(?int $ano_de = null) : void
        {
            $this->ano_de = $ano_de;
        }
        
        public function get_ano_de() : ?int
        {
            return $this->ano_de;
        }
        
        public function set_ano_ate(?int $ano_ate = null) : void
        {
            $this->ano_ate = $ano_ate;
        }
        
        public function get_ano_ate() : ?int
        {
            return $this->ano_ate;
        }
        
        public function set_ano_id(?int $ano_id = null) : void
        {
            $this->ano_id = $ano_id;
        }
        
        public function get_ano_id() : ?int
        {
            return $this->ano_id;
        }
    }
