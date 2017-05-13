<?php
namespace application\model\filter;
	
	use \Exception;
	
    class Endereco {
		
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : void {
			
		}
		
		public static function validar_cidade($cidade = null) : Object_Cidade {
			if (empty($cidade)) {
				throw new Exception("Selecione sua Cidade");
			} else {
				if (filter_var($cidade, FILTER_VALIDATE_INT)) {
					$object_cidade = new Object_Cidade();
					
					$object_cidade->set_id($cidade);
					
					return $object_cidade;
				} else {
					throw new Exception("Selecione uma Cidade Válida");
				}
			}
		}
		
		public static function validar_estado($estado = null) : Object_Estado {
			if (empty($estado)) {
				throw new Exception("Selecione seu Estado");
			} else {
				if (filter_var($estado, FILTER_VALIDATE_INT)) {
					$object_estado = new Object_Estado();
					
					$object_estado->set_id($estado);
					
					return $object_estado;
				} else {
					throw new Exception("Selecione um Estado Válido");
				}
			}
		}
		
		public static function validar_entidade_id($entidade_id = null) : void {
			
		}
		
		public static function validar_numero($numero = null) : string {
			if (empty($numero)) {
				throw new Exception("Informe o Numero do seu Endereço");
			} else {
				$valor = strip_tags($numero);
				
				if ($valor === $numero) {
					$numero = trim($numero);
					
					if (strlen($numero) <= 10) {
						return $numero;
					} else {
						throw new Exception("Numero do Estabelecimento, Não pode conter mais de 10 Caracteres");
					}
				} else {
					throw new Exception("Numero do Estabelecimento, Não pode conter Tags de Programação");
				}
			}
		}
		
		public static function validar_cep($cep = null) : string {
			if (empty($cep)) {
				throw new Exception("Informe seu CEP");
			} else {
				$cep = trim($cep);
				$cep = preg_replace('/[^a-zA-Z0-9]/', "", $cep);
				
				if (strlen($cep) === 8) {
					if (filter_var($cep, FILTER_VALIDATE_INT)) {
						return $cep;
					} else {
						throw new Exception("CEP, Digite Apenas os Numeros");
					}
				} else {
					throw new Exception("CEP Deve conter 8 Numeros");
				}
			}
		}
		
		public static function validar_rua($rua = null) : string {
			if (empty($rua)) {
				throw new Exception("Informe sua Rua");
			} else {
				$valor = strip_tags($rua);
				
				if ($valor === $rua) {
					$rua = trim($rua);
					$rua = preg_replace('/\s+/', " ", $rua);
					
					if (strlen($rua) <= 150) {
						return ucwords(strtolower($rua));
					} else {
						throw new Exception("Rua, Não pode conter mais de 150 Caracteres");
					}
				} else {
					throw new Exception("Rua, Não pode conter Tags de Programação");
				}
			}
		}
		
		public static function validar_complemento($complemento = null) : string {
			if (!empty($complemento)) {
				$valor = strip_tags($complemento);
				
				if ($valor === $complemento) {
					$complemento = trim($complemento);
					$complemento = preg_replace('/\s+/', " ", $complemento);
					
					if (strlen($complemento) <= 150) {
						return ucfirst(strtolower($complemento));
					} else {
						throw new Exception("Complemento, Não pode conter mais de 150 Caracteres");
					}
				} else {
					throw new Exception("Complemento, Não pode conter Tags de Programação");
				}
			}
		}
		
		public static function validar_bairro($bairro = null) : string {
			if (empty($bairro)) {
				throw new Exception("Informe seu Bairro");
			} else {
				$valor = strip_tags($bairro);
				
				if ($valor === $bairro) {
					$bairro = trim($bairro);
					$bairro = preg_replace('/\s+/', " ", $bairro);
					
					if (strlen($bairro) <= 150) {
						return ucwords(strtolower($bairro));
					} else {
						throw new Exception("Bairro, Não pode conter mais de 150 Caracteres");
					}
				} else {
					throw new Exception("Bairro, Não pode conter Tags de Programação");
				}
			}
		}
		
		public static function filtrar_id($id = null) : void {
			
		}
		
		public static function filtrar_cidade($cidade = null) : void {
			
		}
        
		public static function filtrar_estado($estado = null) : void {
            
        }
		
        public static function filtrar_entidade_id($entidade_id = null) : void {
            
        }
        
        public static function filtrar_numero($numero = null) : string {
        	$valor = "";
        	
        	if (!empty($numero)) {
        		$valor = trim(strip_tags($numero));
        	}
        	
        	return $valor;
		}
		
		public static function filtrar_cep($cep = null) : string {
			$valor = "";
			
			if (!empty($cep)) {
				$valor = trim(strip_tags($cep));
			}
			
			return $valor;
		}
		
		public static function filtrar_rua($rua = null) : string {
			$valor = "";
			
			if (!empty($rua)) {
				$valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($rua)))));
			}
			
			return $valor;
		}
		
		public static function filtrar_complemento($complemento = null) : string {
			$valor = "";
			
			if (!empty($complemento)) {
				$valor = ucfirst(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($complemento)))));
			}
			
			return $valor;
		}
		
		public static function filtrar_bairro($bairro = null) : void {
			$valor = "";
			
			if (!empty($bairro)) {
				$valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($bairro)))));
			}
			
			return $valor;
		}
    }
?>