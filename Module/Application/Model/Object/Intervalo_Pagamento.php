<?php
namespace Module\Application\Model\Object;

    class Intervalo_Pagamento
    {
    	
    	private $id;
		private $descricao;
		
		function __constructor()
		{
			
		}
		
		public function set_id(int $id) : void
		{
			$this->id = $id;
		}
		
		public function get_id() : ?int
		{
			return $this->id;
		}
		
		public function set_descricao(string $descricao) : void
		{
		    $this->descricao = $descricao;
		}
		
		public function get_descricao() : ?string
		{
		    return $this->descricao;
		}
    }
