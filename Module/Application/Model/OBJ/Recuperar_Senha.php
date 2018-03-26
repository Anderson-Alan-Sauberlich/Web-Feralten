<?php
namespace Module\Application\Model\OBJ;
    
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    
    class Recuperar_Senha
    {
        private $obj_usuario;
        private $data_hora;
        private $codigo;
        
        function __constructor()
        {
            
        }
        
        public function set_obj_usuario(OBJ_Usuario $obj_usuario) : void
        {
            $this->obj_usuario = $obj_usuario;
        }
        
        public function get_obj_usuario() : ?OBJ_Usuario
        {
            return $this->obj_usuario;
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
