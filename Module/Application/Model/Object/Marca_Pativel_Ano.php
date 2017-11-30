<?php
namespace Module\Application\Model\Object;
    
    class Marca_Pativel_Ano
    {
        
        private $anos = array();
        private $ano_id;
        
        function __constructor()
        {
            
        }
        
        public function set_anos(?array $anos = null) : void
        {
            $this->anos = $anos;
        }
        
        public function get_anos() : ?array
        {
            return $this->anos;
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
