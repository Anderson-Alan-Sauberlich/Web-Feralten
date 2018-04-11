<?php
namespace Module\Application\Model\OBJ;
    
    use Module\Application\Model\OBJ\Entidade as OBJ_Entidade;
    
    class Cancelar_Contratacao
    {
        private $obj_entidade;
        private $data_hora;
        private $codigo;
        
        function __constructor()
        {
            
        }
        
        public function set_obj_entidade(OBJ_Entidade $obj_entidade) : void
        {
            $this->obj_entidade = $obj_entidade;
        }
        
        public function get_obj_entidade() : ?OBJ_Entidade
        {
            return $this->obj_entidade;
        }
        
        public function set_data_hora(string $data_hora) : void
        {
            $this->data_hora = $data_hora;
        }
        
        public function get_data_hora() : ?string
        {
            return $this->data_hora;
        }
        
        public function set_codigo(string $codigo) : void
        {
            $this->codigo = $codigo;
        }
        
        public function get_codigo() : ?string
        {
            return $this->codigo;
        }
    }
