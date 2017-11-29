<?php
namespace Module\Application\Model\Validador;
	
	use \Exception;
	
    class Categoria_Pativel
    {
		
		function __constructor()
		{
			
		}
		
		public static function validar_peca_id($peca_id = null) : void
		{
			
		}
		
		public static function validar_categoria_id($categoria_id = null) : void
		{
			
		}
		
		public static function validar_ano($ano = null) : void
		{
			
		}
		
		public static function validar_ano_de($ano_de = null) : ?int
		{
			if (!empty($ano_de)) {
				$ano_de = trim($ano_de);
				
				if (filter_var($ano_de, FILTER_VALIDATE_INT) !== false) {
					return $ano_de;
				} else {
					return null;
				}
			} else {
				return null;
			}
		}
		
		public static function validar_ano_ate($ano_ate = null) : ?int
		{
			if (!empty($ano_ate)) {
				$ano_ate = trim($ano_ate);
				
				if (filter_var($ano_ate, FILTER_VALIDATE_INT) !== false) {
					return $ano_ate;
				} else {
					return null;
				}
			} else {
				return null;
			}
		}
		
		public static function validar_anos($anos = null) : void
		{
			
		}
		
		public static function filtrar_peca_id($peca_id = null) : void
		{
			
		}
		
		public static function filtrar_categoria_id($categoria_id = null) : void
		{
			
		}
		
		public static function filtrar_ano($ano = null) : void
		{
			
		}
		
		public static function filtrar_ano_de($ano_de = null) : ?int
		{
			$valor = null;
			
			if (!empty($ano_de) AND filter_var($ano_de, FILTER_VALIDATE_INT)) {
				$valor = trim($ano_de);
			}
			
			return $valor;
		}
		
		public static function filtrar_ano_ate($ano_ate = null) : ?int
		{
			$valor = null;
			
			if (!empty($ano_ate) AND filter_var($ano_ate, FILTER_VALIDATE_INT)) {
				$valor = trim($ano_ate);
			}
			
			return $valor;
		}
		
		public static function filtrar_anos($anos = null) : void
		{
			
		}
    }
