<?php
namespace application\model\validador;
	
	use \Exception;
	
    class Foto_Peca {
		
		function __constructor() {
			
		}
		
		public function validar_peca_id($peca_id = null) : void {
			
		}
		
		public function validar_endereco($endereco = null) : void {
			
		}
		
		public function validar_numero($numero = null) : void {
			
		}
		
		public function validar_descricao_nome($img_descricao = null) : ?string {
			
		}
		
		public function validar_imagem($imagem = null, $numero = null) : ?array {
			if (isset($numero) AND !empty($numero) AND filter_var($numero, FILTER_VALIDATE_INT)) {
				if (isset($imagem['name']) AND !empty($imagem['name'])) {
					if (isset($imagem['error']) AND $imagem['error'] === 0) {
						if (isset($imagem['type']) AND ($imagem['type'] == 'image/jpeg' OR $imagem['type'] == 'image/png' OR $imagem['type'] == 'image/jpg')) {
							if (isset($imagem['tmp_name']) AND !empty($imagem['tmp_name'])) {
								list($largura, $altura) = getimagesize($imagem['tmp_name']);
								
								if($largura >= 800 && $altura >= 600) {
									return $imagem;
								} else {
									throw new Exception('Imagem com tamanho incorreto. (Tamanho Mínimo: 800 x 600 px.)');
								}
							} else {
								throw new Exception("Imagem $numero Não Encontrada");
							}
						} else {
							throw new Exception("Imagem $numero Inválida");
						}
					} else {
						throw new Exception("Erro ao Carregar Imagem $numero");
					}
				} else {
					return null;
				}
			} else {
				return null;
			}
		}
		
		public function filtrar_peca_id($peca_id = null) : void {
			
		}
		
		public function filtrar_endereco($endereco = null) : void {
			
		}
		
		public function filtrar_numero($numero = null) : void {
			
		}
		
		public function filtrar_descricao_nome($img_descricao = null) : ?string {
			$valor = null;
			
			if (!empty($img_descricao)) {
				$img_descricao = iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $img_descricao);
				$img_descricao = trim($img_descricao);
				$img_descricao = preg_replace('/\s+/', '-', $img_descricao);
				$img_descricao = preg_replace(array('/[ ]/', '/[^A-Za-z0-9\-]/'), array('', ''), $img_descricao);
				
				$valor = $img_descricao;
			}
			
			return $valor;
		}
		
		public function filtrar_imagem($imagem = null) : void {
			
		}
    }
?>