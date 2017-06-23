<?php
namespace application\model\validador;
	
	use \Exception;
	
    class Status_Peca {
    	
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : void {
			
		}
		
		public static function validar_nome($nome = null) : void {
			
		}
		
		public static function validar_url($url = null) : ?string {
			if (!empty($url)) {
				$valor = strip_tags($url);
				
				if ($valor === $url) {
					$url = trim($url);
					
					return strtolower($url);
				} else {
					throw new Exception('URL do Status da Peça, Não pode conter Tags de Programação');
				}
			} else {
				throw new Exception('URL do Status da Peça, Não Informada');
			}
		}
		
		public static function filtrar_id($id = null) : void {
			
		}
		
		public static function filtrar_nome($nome = null) : void {
			
		}
		
		public static function filtrar_url($url = null) : void {
			
		}
    }
?>