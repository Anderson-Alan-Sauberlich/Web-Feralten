<?php
namespace module\application\model\validador;
	
	use \Exception;
	
    class Contador_Clique {
		
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : int {
		    
		}
		
		public static function validar_peca_id($peca_id = null) : int {
		    if (empty($peca_id)) {
		        throw new Exception("Codigo da Peça não identificado");
		    } else {
		        if (filter_var($peca_id, FILTER_VALIDATE_INT)) {
		            return $peca_id;
		        } else {
		            throw new Exception("Codigo da Peça Invalido");
		        }
		    }
		}
		
		public static function validar_datahora($datahora = null) : string {
		    
		}
		
		public static function filtrar_id($id = null) : int {
			
		}
		
		public static function filtrar_peca_id($peca_id = null) : int {
			
		}
		
		public static function filtrar_datahora_envio($datahora_envio = null) : string {
		    
		}
    }
?>