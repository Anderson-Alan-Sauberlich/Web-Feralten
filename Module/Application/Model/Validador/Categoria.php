<?php
namespace Module\Application\Model\Validador;
	
	use \Exception;
	
    class Categoria
    {
		
		function __constructor()
		{
			
		}
		
		public static function validar_id($id = null) : int
		{
			if (empty($id)) {
				throw new Exception('Selecione a Categoria');
			} else {
				if (filter_var($id, FILTER_VALIDATE_INT)) {
					return $id;
				} else {
					throw new Exception('Selecione uma Categoria Válida');
				}
			}
		}
		
		public static function validar_nome($nome = null) : void
		{
			
		}
		
		public static function validar_url($url_categoria = null) : string
		{
			if (empty($url_categoria)) {
				throw new Exception('URL da Categoria não Informado');
			} else {
				$url_categoria = trim($url_categoria);
				
				if (strip_tags($url_categoria) === $url_categoria) {
					return $url_categoria;
				} else {
					throw new Exception('URL da Categoria Inválida');
				}
			}
		}
		
		public static function filtrar_id($id = null) : int
		{
			$valor = 0;
			
			if (!empty($id) AND filter_var($id, FILTER_VALIDATE_INT)) {
				$valor = $id;
			}
			
			return $valor;
		}
		
		public static function filtrar_nome($nome = null) : void
		{
			
		}
		
		public static function filtrar_url($url_categoria = null) : string
		{
			$valor = '';
			
			if (!empty($url_categoria) AND filter_var($url_categoria, FILTER_VALIDATE_URL)) {
				$valor = $url_categoria;
			}
			
			return $valor;
		}
    }
