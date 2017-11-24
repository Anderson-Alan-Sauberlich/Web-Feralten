<?php
namespace module\application\model\object;
    
    use module\application\model\object\Modelo as Object_Modelo;
    
    class Modelo_Pativel
    {
    	
    	private $peca_id;
    	private $object_modelo;
		private $ano_de;
		private $ano_ate;
		private $anos = array();
		private $ano_id;
		
		function __constructor()
		{
			
		}
		
		public function set_peca_id(int $peca_id) : void
		{
			$this->peca_id = $peca_id;
		}
		
		public function get_peca_id() : ?int
		{
			return $this->peca_id;
		}
		
		public function set_object_modelo(Object_Modelo $object_modelo) : void
		{
		    $this->object_modelo = $object_modelo;
		}
		
		public function get_object_modelo() : ?Object_Modelo
		{
		    return $this->object_modelo;
		}
		
		public function set_ano(?int $ano = null) : void
		{
			$this->anos[] = $ano;
		}
		
		public function set_anos(?array $anos = null) : void
		{
			$this->anos = $anos;
		}
		
		public function get_anos() : ?array
		{
			return $this->anos;
		}
		
		public function set_ano_de(?int $ano_de = null) : void
		{
			$this->ano_de = $ano_de;
		}
		
		public function get_ano_de() : ?int
		{
			return $this->ano_de;
		}
		
		public function set_ano_ate(?int $ano_ate = null) : void
		{
			$this->ano_ate = $ano_ate;
		}
		
		public function get_ano_ate() : ?int
		{
			return $this->ano_ate;
		}
		
		public function set_ano_id(?int $ano_id = null) : void
		{
			$this->ano_id = $ano_id;
		}
		
		public function get_ano_id() : ?int
		{
			return $this->ano_id;
		}
    }
