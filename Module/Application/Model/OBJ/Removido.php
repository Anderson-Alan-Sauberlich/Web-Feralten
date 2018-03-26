<?php
namespace Module\Application\Model\OBJ;
    
    use Module\Application\Model\OBJ\Entidade as OBJ_Entidade;
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    
    class Removido
    {
        private $id;
        private $obj_entidade;
        private $obj_usuario;
        private $datahora;
        
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
        
        public function set_obj_entidade(OBJ_Entidade $obj_entidade) : void
        {
            $this->obj_entidade = $obj_entidade;
        }
        
        public function get_obj_entidade() : ?OBJ_Entidade
        {
            return $this->obj_entidade;
        }
        
        public function set_obj_usuario(OBJ_Usuario $obj_usuario) : void
        {
            $this->obj_usuario = $obj_usuario;
        }
        
        public function get_obj_usuario() : ?OBJ_Usuario
        {
            return $this->obj_usuario;
        }
        
        public function set_datahora(string $datahora) : void
        {
            $this->datahora = $datahora;
        }
        
        public function get_datahora() : ?string
        {
            return $this->datahora;
        }
    }
