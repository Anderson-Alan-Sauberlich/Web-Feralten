<?php
namespace application\model\object;

    class Versao_Pativel {
    	
    	private $peca_id;
		private $versao_id;
		private $ano_de;
		private $ano_ate;
		private $anos = array();
		
		function __constructor() {
			
		}
		
		public function set_peca_id(int $peca_id) : void {
			$this->peca_id = $peca_id;
		}
		
		public function get_peca_id() : ?int {
			return $this->peca_id;
		}
		
		public function set_versao_id(int $versao_id) : void {
			$this->versao_id = $versao_id;
		}
		
		public function get_versao_id() : ?int {
			return $this->versao_id;
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
		
		public function set_ano_de(?int $ano_de = null) : void {
			$this->ano_de = $ano_de;
		}
		
		public function get_ano_de() : ?int {
			return $this->ano_de;
		}
		
		public function set_ano_ate(?int $ano_ate = null) : void {
			$this->ano_ate = $ano_ate;
		}
		
		public function get_ano_ate() : ?int {
			return $this->ano_ate;
		}
    }
?>