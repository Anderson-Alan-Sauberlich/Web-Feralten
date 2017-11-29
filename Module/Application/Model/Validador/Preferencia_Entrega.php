<?php
namespace Module\Application\Model\Validador;
	
	use \Exception;
	
    class Preferencia_Entrega
    {
    	
		function __constructor()
		{
			
		}
		
		public function validar_id($id = null) : ?int
		{
		    if (!empty($id)) {
		        if (filter_var($id, FILTER_VALIDATE_INT)) {
		            return $id;
		        } else {
		            throw new Exception('Selecione um Status para Peça Válido.');
		        }
		    } else {
		        return null;
		    }
		}
		
		public function validar_nome($nome = null) : void
		{
			
		}
		
		public function validar_url($url = null) : ?string
		{
			if (!empty($url)) {
				$valor = strip_tags($url);
				
				if ($valor === $url) {
					$url = trim($url);
					
					return strtolower($url);
				} else {
					throw new Exception('URL da Preferência Entrega, Não pode conter Tags de Programação');
				}
			} else {
				throw new Exception('URL da Preferência Entrega, Não Informada');
			}
		}
		
		public function filtrar_id($id = null) : void
		{
			
		}
		
		public function filtrar_nome($nome = null) : void
		{
			
		}
		
		public function filtrar_url($url = null) : void
		{
			
		}
    }
