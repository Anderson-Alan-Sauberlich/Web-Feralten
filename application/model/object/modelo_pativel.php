<?php
namespace application\model\object;

    class Modelo_Pativel {
    	
    	private $peca_id;
		private $modelo_id;
		private $anos = array();
		
		function __constructor() {
			
		}
		
		public function set_peca_id(int $peca_id) : void {
			$this->peca_id = $peca_id;
		}
		
		public function get_peca_id() : ?int {
			return $this->peca_id;
		}
		
		public function set_modelo_id(int $modelo_id) : void {
			$this->modelo_id = $modelo_id;
		}
		
		public function get_modelo_id() : ?int {
			return $this->modelo_id;
		}
		
		public function set_ano(?int $ano = null) : void {
			$this->anos[] = $ano;
		}
		
		public function set_anos(?array $anos = null) : void {
			$this->anos = $anos;
		}
		
		public function get_anos() : ?array {
			return $this->anos;
		}
    }
?>