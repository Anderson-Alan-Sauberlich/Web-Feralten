<?php
namespace module\application\model\validador;
	
	use \Exception;
	
    class Marca {
    	
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : int {
			if (empty($id)) {
				throw new Exception("Selecione a Marca");
			} else {
				if (filter_var($id, FILTER_VALIDATE_INT)) {
					return $id;
				} else {
					throw new Exception("Selecione uma Marca Válida");
				}
			}
		}
		
		public static function validar_categoria_id($categoria_id = null) : void {
			
		}
		
		public static function validar_nome($nome = null) : void {
			
		}
		
		public static function validar_url($url_marca = null) : string {
			if (empty($url_marca)) {
				throw new Exception('URL da Marca não Informado');
			} else {
				$url_marca = trim($url_marca);
				
				if (strip_tags($url_marca) === $url_marca) {
					return $url_marca;
				} else {
					throw new Exception('URL da Marca Inválida');
				}
			}
		}
		
		public static function filtrar_id($id = null) : int {
			$valor = 0;
			
			if (!empty($id) AND filter_var($id, FILTER_VALIDATE_INT)) {
				$valor = $id;
			}
			
			return $valor;
		}
		
		public static function filtrar_categoria_id($categoria_id = null) : void {
			
		}
		
		public static function filtrar_nome($nome = null) : void {
			
		}
		
		public static function filtrar_url($url_marca = null) : string {
			$valor = '';
			
			if (!empty($url_marca) AND filter_var($url_marca, FILTER_VALIDATE_URL)) {
				$valor = $url_marca;
			}
			
			return $valor;
		}
    }
?>