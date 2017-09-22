<?php
namespace module\application\model\object;
    
    use module\application\model\object\Peca as Object_Peca;
    
    class Contador_Clique {
    	
    	private $id;
		private $object_peca;
		private $datahora;
		
		function __constructor() {
			
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : ?int {
			return $this->id;
		}
		
		public function set_object_peca(Object_Peca $object_peca) : void {
		    $this->object_peca = $object_peca;
		}
		
		public function get_object_peca() : ?Object_Peca {
		    return $this->object_peca;
		}
		
		public function set_datahora(string $datahora) : void {
		    $this->datahora = $datahora;
		}
		
		public function get_datahora() : ?string {
		    return $this->datahora;
		}
    }
?>