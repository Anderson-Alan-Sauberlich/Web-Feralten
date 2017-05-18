<?php
namespace application\model\filter;
	
	use \Exception;
	
    class Modelo {
    	
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : int {
			if (empty($id)) {
				throw new Exception("Selecione o Modelo");
			} else {
				if (filter_var($id, FILTER_VALIDATE_INT)) {
					return $id;
				} else {
					throw new Exception("Selecione um Modelo Válido");
				}
			}
		}
		
		public static function validar_marca_id($marca_id = null) : void {
			
		}
		
		public static function validar_nome($nome = null) : void {
			
		}
		
		public static function validar_url($url = null) : void {
			
		}
		
		public static function filtrar_id($id = null) : int {
			$valor = 0;
			
			if (!empty($id) AND filter_var($id, FILTER_VALIDATE_INT)) {
				$valor = $id;
			}
			
			return $valor;
		}
		
		public static function filtrar_marca_id($marca_id = null) : void {
			
		}
		
		public static function filtrar_nome($nome = null) : void {
			
		}
		
		public static function filtrar_url($url = null) : void {
			
		}
    }
?>