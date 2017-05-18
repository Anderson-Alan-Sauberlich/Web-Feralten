<?php
namespace application\model\filter;
	
	use \Exception;
	
    class Peca {
		
		function __constructor() {
			
		}
		
		public static function validar_id($id = null) : void {
			
		}
		
		public static function validar_entidade($entidade = null) : void {
			
		}
		
		public static function validar_responsavel($usuario_responsavel = null) : void {
			
		}
		
		public static function validar_nome($nome = null) : string {
			if (!empty($nome)) {
				$valor = strip_tags($nome);
				
				if ($valor === $nome) {
					$nome = trim($nome);
					$nome = preg_replace('/\s+/', " ", $nome);
					
					if (strlen($nome) <= 50) {
						return ucwords(strtolower($nome));
					} else {
						throw new Exception('Peça Nome, Não pode conter mais de 50 Caracteres');
					}
				} else {
					throw new Exception('Peça Nome, Não pode conter Tags de Programação');
				}
			} else {
				throw new Exception('Digite o Nome da Peça');
			}
		}
		
		public static function validar_fabricante($fabricante = null) : ?string {
			if (!empty($fabricante)) {
				$valor = strip_tags($fabricante);
				
				if ($valor === $fabricante) {
					$fabricante = trim($fabricante);
					$fabricante = preg_replace('/\s+/', " ", $fabricante);
					
					if (strlen($fabricante) <= 50) {
						return ucwords(strtolower($fabricante));
					} else {
						throw new Exception('Fabricante, Não pode conter mais de 50 Caracteres');
					}
				} else {
					throw new Exception('Fabricante, Não pode conter Tags de Programação');
				}
			} else {
				return null;
			}
		}
		
		public static function validar_serie($serie = null) : ?string {
			if (!empty($serie)) {
				$valor = strip_tags($serie);
				
				if ($valor=== $serie) {
					$serie = trim($serie);
					$serie = preg_replace('/\s+/', " ", $serie);
					
					if (strlen($serie) <= 150) {
						return $serie;
					} else {
						throw new Exception('Numero de Serie, Não pode conter mais de 150 Caracteres');
					}
				} else {
					throw new Exception('Numero de Serie, Não pode conter Tags de Programação');
				}
			} else {
				return null;
			}
		}
		
		public static function validar_endereco($endereco = null) : void {
			
		}
		
		public static function validar_preco($preco = null) : ?float {
			if (!empty($preco)) {
				if (filter_var($preco, FILTER_VALIDATE_FLOAT)) {
					return $preco;
				} else {
					throw new Exception('Digite um Preço Valido para a peça');
				}
			} else {
				return null;
			}
		}
		
		public static function validar_data_anuncio($data_anuncio = null) : void {
			
		}
		
		public static function validar_descricao($descricao = null) : ?string {
			if (!empty($descricao)) {
				$valor = strip_tags($this->descricao);
				
				if ($valor === $descricao) {
					$descricao = trim($descricao);
					$descricao = preg_replace('/\s+/', " ", $descricao);
					
					if (strlen($descricao) <= 1000) {
						return ucfirst($descricao);
					} else {
						throw new Exception('Descricao, Não pode conter mais de 1000 Caracteres');
					}
				} else {
					throw new Exception('Descricao, Não pode conter Tags de Programação');
				}
			} else {
				return null;
			}
		}
		
		public static function validar_prioridade($prioridade = null) : ?bool {
			if (!empty($prioridade)) {
				return true;
			} else {
				return null;
			}
		}
		
		public static function validar_status($status = null) : ?int {
			if (!empty($status)) {
				if (filter_var($status, FILTER_VALIDATE_INT)) {
					return $status;
				} else {
					throw new Exception('Selecione um Status Valido.');
				}
			} else {
				return null;
			}
		}
		
		public static function validar_fotos($fotos = null) : void {
			
		}
		
		public static function validar_foto($foto = null) : void {
			
		}
		
		public static function validar_preferencia_entrega($preferencia_entrega = null) : ?int {
			if (!empty($preferencia_entrega)) {
				$valor = 0;
				
				if (is_array($preferencia_entrega)) {
					foreach ($preferencia_entrega as $numero) {
						if (filter_var($numero, FILTER_VALIDATE_INT)) {
							$valor += $numero;
						}
					}
					
					if (!empty($valor) AND filter_var($valor, FILTER_VALIDATE_INT) AND $valor > 0) {
						return $valor;
					} else {
						return null;
					}
				} else {
					return null;
				}
			} else {
				return null;
			}
		}
		
		public static function filtrar_id($id = null) : void {
			
		}
		
		public static function filtrar_entidade($entidade = null) : void {
			
		}
		
		public static function filtrar_responsavel($usuario_responsavel = null) : void {
			
		}
		
		public static function filtrar_nome($nome = null) : string {
			$valor = "";
			
			if (!empty($nome)) {
				$valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($nome)))));
			}
			
			return $valor;
		}
		
		public static function filtrar_fabricante($fabricante = null) : ?string {
			$valor = null;
			
			if (!empty($fabricante)) {
				$valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($fabricante)))));
			}
			
			return $valor;
		}
		
		public static function filtrar_serie($serie = null) : ?string {
			$valor = null;
			
			if (!empty($serie)) {
				$valor = trim(strip_tags($serie));
			}
			
			return $valor;
		}
		
		public static function filtrar_endereco($endereco = null) : void {
			
		}
		
		public static function filtrar_preco($preco = null) : ?float {
			$valor = null;
			
			if (!empty($preco) AND filter_var($preco, FILTER_VALIDATE_FLOAT)) {
				$valor = trim($preco);
			}
			
			return $valor;
		}
		
		public static function filtrar_data_anuncio($data_anuncio = null) : void {
			
		}
		
		public static function filtrar_descricao($descricao = null) : ?string {
			$valor = null;
			
			if (!empty($descricao)) {
				$valor = ucfirst(preg_replace('/\s+/', " ", trim(strip_tags($descricao))));
			}
			
			return $valor;
		}
		
		public static function filtrar_prioridade($prioridade = null) : ?bool {
			$valor = null;
			
			if (!empty($prioridade)) {
				$valor = true;
			}
			
			return $valor;
		}
		
		public static function filtrar_status($status = null) : ?int {
			$valor = null;
			
			if (!empty($status) AND filter_var($status, FILTER_VALIDATE_INT)) {
				$valor = trim($status);
			}
			
			return $valor;
		}
		
		public static function filtrar_fotos($fotos = null) : void {
			
		}
		
		public static function filtrar_foto($foto = null) : void {
			
		}
		
		public static function filtrar_preferencia_entrega($preferencia_entrega = null) : void {
			
		}
    }
?>