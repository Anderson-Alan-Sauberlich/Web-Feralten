<?php
namespace module\application\model\validador;
	
    use module\application\model\common\util\Login_Session;
    use module\application\model\dao\Plano as DAO_Plano;
    use module\application\model\dao\Peca as DAO_Peca;
	use \Exception;
	
    class Plano
    {
		
		function __constructor()
		{
			
		}
		
		public static function validar_id($id = null) : int
		{
		    if (empty($id)) {
		        throw new Exception("Selecione um Plano");
		    } else {
		        if (filter_var($id, FILTER_VALIDATE_INT)) {
		            if ($id != Login_Session::get_entidade_plano()) {
		                if ($id < Login_Session::get_entidade_plano()) {
		                    $limite = DAO_Plano::Buscar_Limite_Por_Id($id);
		                    $pecas = DAO_Peca::Buscar_Quantidade_Pecas_Por_Entidade(Login_session::get_entidade_id());
		                    
    		                if ($pecas > $limite) {
    		                    $diferenca = $pecas - $limite;
    		                    throw new Exception("Você tem $pecas peças cadastradas. Este plano permite no máximo $limite. Você precisa deletar $diferenca peças para ativá-lo.");
    		                }
		                }
		                
		                return $id;
		            } else {
		                throw new Exception('Plano já Ativo');
		            }
		        } else {
		            throw new Exception("Selecione um Plano Válida");
		        }
		    }
		}
		
		public static function validar_valor_mensal($valor_mensal = null) : void
		{
			
		}
		
		public static function validar_valor_anual($valor_anual = null) : void
		{
			
		}
		
		public static function validar_limite_pecas($limite_pecas = null) : void
		{
			
		}
		
		public static function validar_descricao($descricao = null) : void
		{
			
		}
		
		public static function filtrar_id($id = null) : int
		{
		    $valor = 0;
		    
		    if (!empty($id) AND filter_var($id, FILTER_VALIDATE_FLOAT)) {
		        $valor = $id;
		    }
		    
		    return $valor;
		}
		
		public static function filtrar_valor_mensal($valor_mensal = null) : void
		{
		    
		}
		
		public static function filtrar_valor_anual($valor_anual = null) : void
		{
		    
		}
		
		public static function filtrar_limite_pecas($limite_pecas = null) : void
		{
		    
		}
		
		public static function filtrar_descricao($descricao = null) : void
		{
		    
		}
    }
