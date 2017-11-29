<?php
namespace Module\Application\Model\Object;
    
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    
    class Recuperar_Senha
    {
    	
    	private $object_usuario;
		private $data_hora;
		private $codigo;
		
		function __constructor()
		{
			
		}
		
		public function set_object_usuario(Object_Usuario $object_usuario) : void
		{
			$this->object_usuario = $object_usuario;
		}
		
		public function get_object_usuario() : ?Object_Usuario
		{
			return $this->object_usuario;
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
