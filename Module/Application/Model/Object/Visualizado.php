<?php
namespace Module\Application\Model\Object;
    
    use Module\Application\Model\Object\Entidade as Object_Entidade;
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    
    class Visualizado
    {
        
        private $id;
        private $object_entidade;
        private $object_usuario;
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
        
        public function set_object_entidade(Object_Entidade $object_entidade) : void
        {
            $this->object_entidade = $object_entidade;
        }
        
        public function get_object_entidade() : ?Object_Entidade
        {
            return $this->object_entidade;
        }
        
        public function set_object_usuario(Object_Usuario $object_usuario) : void
        {
            $this->object_usuario = $object_usuario;
        }
        
        public function get_object_usuario() : ?Object_Usuario
        {
            return $this->object_usuario;
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
