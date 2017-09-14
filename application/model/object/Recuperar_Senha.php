<?php
namespace application\model\object;

    class Recuperar_Senha {
    	
    	private $usuario_id;
		private $data_hora;
		private $codigo;
		
		function __constructor() {
			
		}
		
		public function set_usuario_id(int $usuario_id) : void {
			$this->usuario_id = $usuario_id;
		}
		
		public function get_usuario_id() : ?int {
			return $this->usuario_id;
		}
		
		public function set_data_hora(string $data_hora) : void {
			$this->data_hora = $data_hora;
		}
		
		public function get_data_hora() : ?string {
			return $this->data_hora;
		}
		
		public function set_codigo(string $codigo) : void {
			$this->codigo = $codigo;
		}
		
		public function get_codigo() : ?string {
			return $this->codigo;
		}
    }
?>