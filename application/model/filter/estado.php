<?php
namespace application\model\filter;
	
	use \Exception;
	
    class Estado {
    	
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : int {
			if (empty($id)) {
				throw new Exception("Selecione seu Estado");
			} else {
				if (filter_var($id, FILTER_VALIDATE_INT)) {
					return $id;
				} else {
					throw new Exception("Selecione um Estado Válido");
				}
			}
		}
		
		public static function validar_uf($uf = null) : string {
			
		}
		
		public static function validar_nome($nome = null) : string {
			
		}
		
		public static function filtrar_id($id = null) : int {
			$valor = 0;
			
			if (!empty($id) AND filter_var($id, FILTER_VALIDATE_INT)) {
				$valor = $id;
			}
			
			return $valor;
		}
		
		public static function filtrar_uf($uf = null) : string {
			
		}
		
		public static function filtrar_nome($nome = null) : string {
			
		}
    }
?>