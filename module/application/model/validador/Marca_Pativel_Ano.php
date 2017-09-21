<?php
namespace module\application\model\validador;
	
	use \Exception;
	
    class Marca_Pativel_Ano {
    	
		function __constructor() {
			
		}
		
		public static function validar_ano($ano = null) : void {
			
		}
		
		public static function validar_ano_de($ano_de = null) : ?int {
			return Categoria_Pativel::validar_ano_de($ano_de);
		}
		
		public static function validar_ano_ate($ano_ate = null) : ?int {
			return Categoria_Pativel::validar_ano_ate($ano_ate);
		}
		
		public static function validar_anos($anos = null) : void {
			
		}
		
		public static function filtrar_ano($ano = null) : void {
			
		}
		
		public static function filtrar_ano_de($ano_de = null) : ?int {
			return Categoria_Pativel::filtrar_ano_de($ano_de);
		}
		
		public static function filtrar_ano_ate($ano_ate = null) : ?int {
			return Categoria_Pativel::filtrar_ano_ate($ano_ate);
		}
		
		public static function filtrar_anos($anos = null) : void {
			
		}
    }
?>