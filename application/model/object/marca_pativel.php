<?php
namespace application\model\object;

    class Marca_Pativel {
    	
    	private $peca_id;
		private $marca_id;
		private $ano_de;
		private $ano_ate;
		
		function __constructor() {
			
		}
		
		public function set_peca_id(int $peca_id) : void {
			$this->peca_id = $peca_id;
		}
		
		public function get_peca_id() : ?int {
			return $this->peca_id;
		}
		
		public function set_marca_id(?int $marca_id = null) : void {
			$this->marca_id = $marca_id;
		}
		
		public function get_marca_id() : ?int {
			return $this->marca_id;
		}
		
		public function set_ano_de(?string $ano_de = null) : void {
			$this->ano_de = $ano_de;
		}
		
		public function get_ano_de() : ?string {
			return $this->ano_de;
		}
		
		public function set_ano_ate(?string $ano_ate = null) : void {
			$this->ano_ate = $ano_ate;
		}
		
		public function get_ano_ate() : ?string {
			return $this->ano_ate;
		}
    }
?>