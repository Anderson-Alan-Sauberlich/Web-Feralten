<?php
namespace application\model\object;
	
	class Categoria_Compativel {
		private $da_id;
		private $com_id;
	
		function __constructor() {
				
		}
	
		public function set_da_id($da_id) {
			$this->da_id = $da_id;
		}
	
		public function get_da_id() {
			return $this->da_id;
		}
	
		public function set_com_id($com_id) {
			$this->com_id = $com_id;
		}
	
		public function get_com_id() {
			return $this->com_id;
		}
	}
?>