<?php
namespace Module\Application\Model\Validador;
	
	use \Exception;
	
    class Versao
    {
    	
		function __constructor()
		{
			
		}
		
		public static function validar_id($id = null) : int
		{
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
		
		public static function validar_modelo_id($modelo_id = null) : void
		{
			
		}
		
		public static function validar_nome($nome = null) : void
		{
			
		}
		
		public static function validar_url($url_versao = null) : string
		{
			if (empty($url_versao)) {
				throw new Exception('URL da Versão não Informado');
			} else {
				$url_versao = trim($url_versao);
				
				if (strip_tags($url_versao) === $url_versao) {
					return $url_versao;
				} else {
					throw new Exception('URL da Versão Inválida');
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
		
		public static function filtrar_modelo_id($modelo_id = null) : void
		{
			
		}
		
		public static function filtrar_nome($nome = null) : void
		{
			
		}
		
		public static function filtrar_url($url_versao = null) : string
		{
			$valor = '';
			
			if (!empty($url_versao) AND filter_var($url_versao, FILTER_VALIDATE_URL)) {
				$valor = $url_versao;
			}
			
			return $valor;
		}
    }
