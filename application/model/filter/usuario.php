<?php
namespace application\model\filter;
    
	require_once RAIZ.'/application/model/dao/usuario.php';
	
	use application\model\dao\Usuario as DAO_Usuario;
	use \Exception;
	
    class Usuario {
		
		function __constructor() {
			
		}
		
		public static function filtrar_id($id = null) : void {
            
		}
		
		public static function validar_nome($nome = null) : string {
			if (empty($nome)) {
				throw new Exception("Digite Seu Nome Completo");
			} else {
				$valor = strip_tags($nome);
				
				if ($valor === $nome) {
					$nome = trim($nome);
					$nome = preg_replace('/\s+/', " ", $nome);
					
					if (strlen($nome) <= 150) {
						if (preg_match("/^([A-zÀ-ú0-9çÇ ,'-]+)$/", $nome)) {
							return ucwords(strtolower($nome));
						} else {
							throw new Exception("O Nome Não Pode Conter Caracteres Especiais");
						}
					} else {
						throw new Exception("O Nome pode ter no maximo 150 Caracteres");
					}
				} else {
					throw new Exception("O Nome Não pode conter Tags de Programação");
				}
			}
		}
		
		public static function filtrar_nome($nome = null) : string {
			$valor = "";
			
			if (!empty($nome)) {
				$valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($nome)))));
			}
			
			return $valor;
		}
		
		public static function validar_email($email = null) : string {
			
		}
		
		public static function filtrar_email($email = null) : string {
			$valor = "";
			
			if (!empty($email)) {
				$valor = trim(strip_tags($email));
			}
			
			return $valor;
		}
		
		public static function validar_confemail($confemail = null, $email = null) : string {
			if (empty($confemail)) {
				throw new Exception("Preencha o Campo Comfirmar E-Mail");
			} else {
				$confemail = trim($confemail);
				$email = trim($email);
				
				if ($confemail === $email) {
					if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
						if (strlen($email) <= 150) {
							$retorno = DAO_Usuario::Verificar_Email($email);
							
							if ($retorno !== false) {
								if ($retorno === 0) {
									return $email;
								} else {
									throw new Exception("Este E-Mail Já Esta Cadastrado");
								}
							} else {
								throw new Exception("Erro ao tentar Encontrar E-Mail");
							}
						} else {
							throw new Exception("O E-Mail pode ter no maximo 150 Caracteres");
						}
					} else {
						throw new Exception("Este E-Mail Não é Valido");
					}
				} else {
					throw new Exception("Digite os E-Mails Duas Vezes Igualmente");
				}
			}
		}
		
		public static function validar_email_login($email = null) : string {
			if (empty($email)) {
				throw new Exception("Digite seu Email");
			} else {
				$email = trim($email);
				
				if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
					$retorno = DAO_Usuario::Verificar_Email($email);
					
					if ($retorno !== false) {
						if ($retorno !== 0) {
							return $email;
						} else {
							throw new Exception("E-mail não Cadastrado");
						}
					} else {
						throw new Exception("Erro ao tentar Encontrar E-Mail");
					}
				} else {
					throw new Exception("Este E-Mail Não é Valido");
				}
			}
		}
		
		public static function validar_senha_login($senha = null) : string {
			if (empty($senha)) {
				throw new Exception("Digite sua Senha");
			} else {
				$valor = strip_tags($senha);
				
				if ($valor === $senha) {
					return $senha;
				} else {
					throw new Exception("A Senha Não pode conter Tags de Programação");
				}
			}
		}
		
		public static function validar_senha($senha = null) : string {
			if (empty($senha)) {
				throw new Exception("Preencha o Campo Senha");
			} else {
				if (strlen($senha) >= 6 AND strlen($senha) <= 20) {
					$valor = strip_tags($senha);
					
					if ($valor === $senha) {
						return $senha;
					} else {
						throw new Exception("A Senha Não pode conter Tags de Programação");
					}
				} else {
					throw new Exception("A Senha Deve conter de 6 a 20 caracteres");
				}
			}
		}
		
		public static function filtrar_senha($senha = null) : string {
			$valor = "";
			
			if (!empty($senha)) {
				$valor = strip_tags($senha);
			}
			
			return $valor;
		}
		
		public static function validar_manter_login($manter_login = null) : bool {
			if (!empty($manter_login)) {
				return true;
			} else {
				return false;
			}
		}
		
		public static function filtrar_manter_login($manter_login = null) : bool {
			if (!empty($manter_login)) {
				return true;
			} else {
				return false;
			}
		}
		
		public static function filtrar_ultimo_login($ultimo_login = null) : void {
            
		}
		
		public static function filtrar_token($token = null) : void {
            
		}
		
		public static function filtrar_status_id($status_id = null) : void {
			
		}
		
		public static function filtrar_fone1($fone1 = null) : void {
			
		}
		
		public static function filtrar_fone2($fone2 = null) : void {
			
		}
		
		public static function filtrar_email_alternativo($email_alternativo = null) : void {
			
		}
    }
?>