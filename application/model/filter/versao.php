<?php
namespace application\model\filter;
	
	use \Exception;
	
    class Versao {
    	
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : int {
			if (empty($id)) {
				throw new Exception("Selecione a Versão");
			} else {
				if (filter_var($id, FILTER_VALIDATE_INT)) {
					return $id;
				} else {
					throw new Exception("Selecione uma Versão Válida");
				}
			}
		}
		
		public static function validar_modelo_id($modelo_id = null) : void {
			
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
		
		public static function filtrar_modelo_id($modelo_id = null) : void {
			
		}
		
		public static function filtrar_nome($nome = null) : void {
			
		}
		
		public static function filtrar_url($url = null) : void {
			
		}
    }
?>