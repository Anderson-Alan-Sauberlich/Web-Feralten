<?php
namespace application\model\object;

	class Marca_Compativel {
		private $id;
		private $da_id;
		private $com_id;
	
		function __constructor() {
				
		}
		
		public function set_id(int $id) : void {
			$this->id = $id;
		}
		
		public function get_id() : int {
			return $this->id;
		}
	
		public function set_da_id(int $da_id) : void {
			$this->da_id = $da_id;
		}
	
		public function get_da_id() : int {
			return $this->da_id;
		}
	
		public function set_com_id(int $com_id) : void {
			$this->com_id = $com_id;
		}
	
		public function get_com_id() : int {
			return $this->com_id;
		}
	}
?>