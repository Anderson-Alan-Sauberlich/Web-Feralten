<?php
namespace application\model\validador;
	
	use \Exception;
	
    class Contato_Anunciante {
		
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : int {
		    
		}
		
		public static function validar_peca_id($peca_id = null) : int {
			
		}
		
		public static function validar_nome($nome = null) : string {
		    if (empty($nome)) {
		        throw new Exception('Informe seu Nome');
		    } else {
		        $valor = strip_tags($nome);
		        
		        if ($valor === $nome) {
		            $nome = trim($nome);
		            
		            if (strlen($nome) <= 150) {
		                return $nome;
		            } else {
		                throw new Exception('Nome, Não pode conter mais de 150 Caracteres');
		            }
		        } else {
		            throw new Exception('Nome, Não pode conter Tags de Programação');
		        }
		    }
		}
		
		public static function validar_email($email = null) : string {
		    if (empty($email)) {
		        throw new Exception('Informe seu E-Mail');
		    } else {
		        $valor = strip_tags($email);
		        
		        if ($valor === $email) {
		            $email = trim($email);
		            
		            if (strlen($email) <= 150) {
		                return $email;
		            } else {
		                throw new Exception('E-Mail, Não pode conter mais de 150 Caracteres');
		            }
		        } else {
		            throw new Exception('E-Mail, Não pode conter Tags de Programação');
		        }
		    }
		}
		
		public static function validar_aprovacao($aprovacao = null) : string {
		    
		}
		
		public static function validar_lido($lido = null) : string {
		    
		}
		
		public static function validar_telefone($telefone = null) : string {
		    if (empty($telefone)) {
		        throw new Exception('Informe um Nº de Telefone');
		    } else {
		        $telefone = trim($telefone);
		        $telefone = preg_replace('/[^a-zA-Z0-9]/', "", $telefone);
		        
		        if (strlen($telefone) === 11 OR strlen($telefone) === 10) {
		            if (filter_var($telefone, FILTER_VALIDATE_INT)) {
		                return $telefone;
		            } else {
		                throw new Exception('Telefone, Digite Apenas Numeros');
		            }
		        } else {
		            throw new Exception('Telefone deve conter 10 ou 11 Dígitos');
		        }
		    }
		}
		
		public static function validar_whatsapp($whatsapp = null) : bool {
		    if (empty($whatsapp)) {
		        return false;
		    } else {
		        return true;
		    }
		}
		
		public static function validar_mensagem($mensagem = null) : string {
		    if (empty($mensagem)) {
		        throw new Exception('Digite uma Mensagem');
		    } else {
		        $mensagem = strip_tags($mensagem);
		        $mensagem = trim($mensagem);
		        
		        if (strlen($mensagem) <= 1000) {
		            return $mensagem;
		        } else {
		            throw new Exception('Mensagem, Não pode conter mais de 1000 Caracteres');
		        }
		    }
		}
		
		public static function validar_datahora_envio($datahora_envio = null) : string {
		    
		}
		
		public static function filtrar_id($id = null) : int {
			
		}
		
		public static function filtrar_peca_id($peca_id = null) : int {
			
		}
		
		public static function filtrar_nome($nome = null) : string {
			
		}
		
		public static function filtrar_email($email = null) : string {
		    
		}
		
		public static function filtrar_aprovacao($aprovacao = null) : string {
		    
		}
		
		public static function filtrar_lido($lido = null) : string {
		    
		}
		
		public static function filtrar_telefone($telefone = null) : string {
		    
		}
		
		public static function filtrar_whatsapp($whatsapp = null) : string {
		    
		}
		
		public static function filtrar_mensagem($mensagem = null) : string {
		    
		}
		
		public static function filtrar_datahora_envio($datahora_envio = null) : string {
		    
		}
    }
?>