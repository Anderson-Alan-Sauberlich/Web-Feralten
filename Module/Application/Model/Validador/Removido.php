<?php
namespace Module\Application\Model\Validador;
	
	use \Exception;
	
    class Removido
    {
		
		function __constructor()
		{
			
		}
		
		public static function validar_id($id = null) : int
		{
		    
		}
		
		public static function validar_entidade_id($entidade_id = null) : int
		{
		    if (empty($entidade_id)) {
		        throw new Exception("Codigo da Entidade não identificado");
		    } else {
		        if (filter_var($entidade_id, FILTER_VALIDATE_INT)) {
		            return $entidade_id;
		        } else {
		            throw new Exception("Codigo da Entidade Invalido");
		        }
		    }
		}
		
		public static function validar_usuario_id($usuario_id = null) : int
		{
		    if (empty($usuario_id)) {
		        throw new Exception("Codigo do Usuario não identificado");
		    } else {
		        if (filter_var($usuario_id, FILTER_VALIDATE_INT)) {
		            return $usuario_id;
		        } else {
		            throw new Exception("Codigo do Usuario Invalido");
		        }
		    }
		}
		
		public static function validar_datahora($datahora = null) : string
		{
		    
		}
		
		public static function filtrar_id($id = null) : int
		{
			
		}
		
		public static function filtrar_entidade_id($entidade_id = null) : int
		{
			
		}
		
		public static function filtrar_usuario_id($usuario_id = null) : int
		{
		    
		}
		
		public static function filtrar_datahora_envio($datahora_envio = null) : string
		{
		    
		}
    }
