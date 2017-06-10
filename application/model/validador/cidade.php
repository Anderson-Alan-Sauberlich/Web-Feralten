<?php
namespace application\model\validador;
	
	use \Exception;
	
    class Cidade {
		
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : int {
			if (empty($id)) {
				throw new Exception("Selecione sua Cidade");
			} else {
				if (filter_var($id, FILTER_VALIDATE_INT)) {
					return $id;
				} else {
					throw new Exception("Selecione uma Cidade Válida");
				}
			}
		}
		
		public static function validar_estado_id($estado_id = null) : int {
			
		}
		
		public static function validar_nome($nome = null) : string {
			
		}
		
		public static function validar_url($url = null) : string {
			if (!empty($url)) {
				$valor = strip_tags($url);
				
				if ($valor === $url) {
					$url = trim($url);
					
					return strtolower($url);
				} else {
					throw new Exception('URL, Não pode conter Tags de Programação');
				}
			} else {
				throw new Exception('URL, Não Informada');
			}
		}
		
		public static function filtrar_id($id = null) : int {
			$valor = 0;
			
			if (!empty($id) AND filter_var($id, FILTER_VALIDATE_FLOAT)) {
				$valor = $id;
			}
			
			return $valor;
		}
		
		public static function filtrar_estado_id($estado_id = null) : int {
			
		}
		
		public static function filtrar_nome($nome = null) : string {
			
		}
    }
?>