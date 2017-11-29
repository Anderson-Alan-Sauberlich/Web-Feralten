<?php
namespace Module\Application\Model\Validador;
	
	use Module\Application\Model\Validador\Categoria_Pativel;
	use \Exception;
	
    class Marca_Pativel
    {
    	
		function __constructor()
		{
			
		}
		
		public static function validar_peca_id($peca_id = null) : void
		{
			
		}
		
		public static function validar_marca_id($marca_id = null) : void
		{
			
		}
		
		public static function validar_ano($ano = null) : void
		{
			
		}
		
		public static function validar_ano_de($ano_de = null) : ?int
		{
			return Categoria_Pativel::validar_ano_de($ano_de);
		}
		
		public static function validar_ano_ate($ano_ate = null) : ?int
		{
			return Categoria_Pativel::validar_ano_ate($ano_ate);
		}
		
		public static function validar_anos($anos = null) : void
		{
			
		}
		
		public static function filtrar_peca_id($peca_id = null) : void
		{
			
		}
		
		public static function filtrar_marca_id($marca_id = null) : void
		{
			
		}
		
		public static function filtrar_ano($ano = null) : void
		{
			
		}
		
		public static function filtrar_ano_de($ano_de = null) : ?int
		{
			return Categoria_Pativel::filtrar_ano_de($ano_de);
		}
		
		public static function filtrar_ano_ate($ano_ate = null) : ?int
		{
			return Categoria_Pativel::filtrar_ano_ate($ano_ate);
		}
		
		public static function filtrar_anos($anos = null) : void
		{
			
		}
    }
