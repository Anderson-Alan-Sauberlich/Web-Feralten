<?php
namespace application\model\filter;
    
	require_once RAIZ.'/application/model/common/util/login_session.php';
	require_once RAIZ.'/application/model/dao/usuario.php';
	
	use application\model\common\util\Login_Session;
	use application\model\dao\Usuario as DAO_Usuario;
	use \Exception;
	
    class Usuario {
		
		function __constructor() {
			
		}
		
		public static function filtrar_id($id = null) : void {
            
		}
		
		public static function validar_nome($nome = null) : string {
			if (empty($nome)) {
				throw new Exception('Digite Seu Nome Completo');
			} else {
				$valor = strip_tags($nome);
				
				if ($valor === $nome) {
					$nome = trim($nome);
					$nome = preg_replace('/\s+/', " ", $nome);
					
					if (strlen($nome) <= 150) {
						if (preg_match("/^([A-zÀ-ú0-9çÇ ,'-]+)$/", $nome)) {
							return ucwords(strtolower($nome));
						} else {
							throw new Exception('O Nome Não Pode Conter Caracteres Especiais');
						}
					} else {
						throw new Exception('O Nome pode ter no maximo 150 Caracteres');
					}
				} else {
					throw new Exception('O Nome Não pode conter Tags de Programação');
				}
			}
		}
		
		public static function filtrar_nome($nome = null) : string {
			$valor = '';
			
			if (!empty($nome)) {
				$valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($nome)))));
			}
			
			return $valor;
		}
		
		public static function validar_email($email = null) : string {
			if (empty($email)) {
				throw new Exception('Preencha o Campo E-Mail');
			} else {
				$email = trim($email);
				
				if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
					if (strlen($email) <= 150) {
						$retorno = DAO_Usuario::Verificar_Email($email);
							
						if ($retorno !== false) {
							if ($retorno === 0 OR $retorno == Login_Session::get_usuario_id()) {
								return $email;
							} else {
								throw new Exception('Este E-Mail Já Esta Cadastrado');
							}
						} else {
							throw new Exception('Erro ao tentar Encontrar E-Mail');
						}
					} else {
						throw new Exception('O E-Mail pode ter no maximo 150 Caracteres');
					}
				} else {
					throw new Exception('Este E-Mail Não é Valido');
				}
			}
		}
		
		public static function validar_confemail($confemail = null, $email = null) : string {
			if (empty($confemail)) {
				throw new Exception('Preencha o Campo Comfirmar E-Mail');
			} else {
				$confemail = trim($confemail);
				$email = trim($email);
				
				if ($confemail === $email) {
					return $confemail;
				} else {
					throw new Exception('Digite os E-Mails Duas Vezes Igualmente');
				}
			}
		}
		
		public static function validar_email_login($email = null) : string {
			if (empty($email)) {
				throw new Exception('Digite seu Email');
			} else {
				$email = trim($email);
				
				if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
					$retorno = DAO_Usuario::Verificar_Email($email);
					
					if ($retorno !== false) {
						if ($retorno !== 0) {
							return $email;
						} else {
							throw new Exception('E-mail não Cadastrado');
						}
					} else {
						throw new Exception('Erro ao tentar Encontrar E-Mail');
					}
				} else {
					throw new Exception('Este E-Mail Não é Valido');
				}
			}
		}
		
		public static function filtrar_email($email = null) : string {
			$valor = '';
			
			if (!empty($email)) {
				$valor = trim(strip_tags($email));
			}
			
			return $valor;
		}
		
		public static function filtrar_email_alternativo($email = null) : string {
			$valor = '';
			
			if (!empty($email)) {
				$valor = trim(strip_tags($email));
			}
			
			return $valor;
		}
		
		public static function filtrar_confemail($confemail = null) : string {
			$valor = '';
			
			if (!empty($confemail)) {
				$valor = trim(strip_tags($confemail));
			}
			
			return $valor;
		}
		
		public static function filtrar_email_login($email = null) : string {
			$valor = '';
			
			if (!empty($email)) {
				$valor = trim(strip_tags($email));
			}
			
			return $valor;
		}
		
		public static function validar_senha_login($senha = null) : string {
			if (empty($senha)) {
				throw new Exception('Digite sua Senha');
			} else {
				$valor = strip_tags($senha);
				
				if ($valor === $senha) {
					return $senha;
				} else {
					throw new Exception('A Senha Não pode conter Tags de Programação');
				}
			}
		}
		
		public static function validar_senha($senha = null) : string {
			if (empty($senha)) {
				throw new Exception('Preencha o Campo Senha');
			} else {
				if (strlen($senha) >= 6 AND strlen($senha) <= 20) {
					$valor = strip_tags($senha);
					
					if ($valor === $senha) {
						return $senha;
					} else {
						throw new Exception('A Senha Não pode conter Tags de Programação');
					}
				} else {
					throw new Exception('A Senha Deve conter de 6 a 20 caracteres');
				}
			}
		}
		
		public static function validar_senha_antiga($senha_antiga = null) : string {
			if (empty($senha_antiga)) {
				throw new Exception('Digite a Senha Antiga');
			} else {
				$senha_usuario = DAO_Usuario::Buscar_Senha_Usuario(Login_Session::get_usuario_id());
				
				if (password_verify($senha_antiga, $senha_usuario)) {
					return $senha_antiga;
				} else {
					throw new Exception('Senha Antiga Incorreta');
				}
			}
		}
		
		public static function validar_senha_nova($senha_nova = null) : string {
			if (empty($senha_nova)) {
				throw new Exception('Preencha o Campo Nova Senha');
			} else {
				if (strlen($senha_nova) >= 6 AND strlen($senha_nova) <= 20) {
					$valor = strip_tags($senha_nova);
						
					if ($valor === $senha_nova) {
						return $senha_nova;
					} else {
						throw new Exception('A Senha Não pode conter Tags de Programação');
					}
				} else {
					throw new Exception('A Senha Deve conter de 6 a 20 caracteres');
				}
			}
		}
		
		public static function validar_senha_confnova($senha_confnova = null, $senha_nova = null) : string {
			if (empty($senha_confnova)) {
				throw new Exception('Preencha o Campo Confirmar Nova Senha');
			} else {
				if ($senha_nova === $senha_confnova) {
					return $senha_confnova;
				} else {
					throw new Exception("Campos: \"Nova Senha\" e \"Confirmar Nova Senha\", Não estão Iguais.");
				}
			}
		}
		
		public static function filtrar_senha_nova($senha_nova = null) : string {
			$valor = '';
			
			if (!empty($senha_nova)) {
				$valor = strip_tags($senha_nova);
			}
			
			return $valor;
		}
		
		public static function filtrar_senha_confnova($senha_confnova = null) : string {
			$valor = '';
			
			if (!empty($senha_confnova)) {
				$valor = strip_tags($senha_confnova);
			}
			
			return $valor;
		}
		
		public static function filtrar_senha_antiga($senha_antiga = null) : string {
			$valor = '';
			
			if (!empty($senha_antiga)) {
				$valor = strip_tags($senha_antiga);
			}
			
			return $valor;
		}
		
		public static function filtrar_senha($senha = null) : string {
			$valor = '';
			
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
		
		public static function validar_ultimo_login($ultimo_login = null) : void {
			
		}
		
		public static function validar_token($token = null) : void {
			
		}
		
		public static function validar_status_id($status_id = null) : void {
			
		}
		
		public static function validar_fone1($fone1 = null) : string {
			if (empty($fone1)) {
				throw new Exception('Informe um Nº de Telefone para Telefone-1');
			} else {
				$fone1 = trim($fone1);
				$fone1 = preg_replace('/[^a-zA-Z0-9]/', "", $fone1);
				
				if (strlen($fone1) === 11 OR strlen($fone1) === 10) {
					if (filter_var($fone1, FILTER_VALIDATE_INT)) {
						return $fone1;
					} else {
						throw new Exception('Telefone-1, Digite Apenas Numeros');
					}
				} else {
					throw new Exception('Telefone-1 deve conter 10 ou 11 Dígitos');
				}
			}
		}
		
		public static function validar_fone2($fone2 = null) : ?string {
			if (!empty($fone2)) {
				$fone2 = trim($fone2);
				$fone2 = preg_replace('/[^a-zA-Z0-9]/', "", $fone2);
				
				if (strlen($fone2) === 11 OR strlen($fone2) === 10) {
					if (filter_var($fone2, FILTER_VALIDATE_INT)) {
						return $fone2;
					} else {
						throw new Exception('Telefone-2, Digite Apenas Numeros');
					}
				} else {
					throw new Exception('Telefone-2 deve conter 10 ou 11 Dígitos');
				}
			} else {
				return null;
			}
		}
		
		public static function validar_email_alternativo($email_alternativo = null) : ?string {
			if (!empty($email_alternativo)) {
				$email_alternativo = trim($email_alternativo);
				
				if (strlen($email_alternativo) <= 150) {
					if (filter_var($email_alternativo, FILTER_VALIDATE_EMAIL)) {
						return $email_alternativo;
					} else {
						throw new Exception('Digite um E-Mail Alternativo Valido');
					}
				} else {
					throw new Exception('E-Mail Alternativo Não pode ter mais de 150 Caracteres');
				}
			} else {
				return null;
			}
		}
		
		public static function filtrar_ultimo_login($ultimo_login = null) : void {
            
		}
		
		public static function filtrar_token($token = null) : void {
            
		}
		
		public static function filtrar_status_id($status_id = null) : void {
			
		}
		
		public static function filtrar_fone1($fone1 = null) : string {
			$valor = "";
			
			if (!empty($fone1)) {
				$valor = trim(strip_tags($fone1));
			}
			
			return $valor;
		}
		
		public static function filtrar_fone2($fone2 = null) : ?string {
			$valor = null;
			
			if (!empty($fone2)) {
				$valor = trim(strip_tags($fone2));
			}
			
			return $valor;
		}
    }
?>