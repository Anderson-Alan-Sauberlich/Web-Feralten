<?php
namespace application\model\util;

	require_once RAIZ.'/application/model/object/usuario.php';
	
	use application\model\object\Usuario as Object_Usuario;
	use DirectoryIterator;

	class Gerenciar_Imagens {
		
		function __construct() {
			$this->usuario = unserialize($_SESSION['usuario'])->get_id();
		}
		
		private $caminho;
		private $extensao;
		private $diretorio;
		private $destino;
		private $tipo;
		private $nome;
		private $usuario;
		private $pasta_usuario;
		
		public function get_nome() {
			return $this->nome;
		}
		
		public function get_caminho() {
			return $this->caminho;
		}
		
		public function get_extensao() {
			return $this->extensao;
		}
		
		public function get_diretorio() {
			return $this->diretorio;
		}
		
		public function get_destino() {
			return $this->destino;
		}
		
		public function get_tipo() {
			return $this->tipo;
		}
		
		public function Armazenar_Imagem_Temporaria($arquivo) {
            $info = explode("/", $arquivo['type']);
            
            $this->tipo = $info[0];
            $this->extensao = $info[1];
			
			$this->pasta_usuario = $_SERVER['DOCUMENT_ROOT']."/imagens/".$this->usuario."/";
            $this->diretorio = $this->pasta_usuario."tmp/";
            
            if (file_exists($this->pasta_usuario)) {
            	if (!file_exists($this->diretorio)) {
            		mkdir($this->diretorio, 0777, true);
            		chmod($this->diretorio, 0777);
            	}
            } else {
            	mkdir($this->pasta_usuario, 0777, true);
            	chmod($this->pasta_usuario, 0777);
            	mkdir($this->diretorio, 0777, true);
            	chmod($this->diretorio, 0777);
            }
						
			$this->Gerenciar_Temporarios();
			
            if ($this->Validar_Imagem()) {
                $this->nome = uniqid();
				
				$this->caminho = $this->diretorio.$this->nome;
                
                $imagem_tmp = $this->caminho.".".$this->extensao;
                
                move_uploaded_file($arquivo['tmp_name'], $imagem_tmp);
                
				$this->Redimencionar_Imagem(800, 600, $imagem_tmp);
				$this->Redimencionar_Imagem(400, 300, $imagem_tmp);
				$this->Redimencionar_Imagem(320, 240, $imagem_tmp);
				$this->Redimencionar_Imagem(200, 150, $imagem_tmp);
				$this->Redimencionar_Imagem(100, 75, $imagem_tmp);
				
				unlink($imagem_tmp);
            } else if (isset($extensao) AND isset($tipo)) {
                return "O Arquivo selecionado não é uma imagem Valida";
            }
		}

		public function Atualizar_Imagem_Usuario($nome_tmp) {
        	$this->pasta_usuario = $_SERVER['DOCUMENT_ROOT']."/imagens/".$this->usuario."/";
        	$this->diretorio = $this->pasta_usuario."tmp/";

			$this->Deletar_Imagem_Usuario();
			
			if (file_exists($this->diretorio)) {
				$this->Gerenciar_Temporarios();
				
				$iterator = new DirectoryIterator($this->diretorio);
				
				foreach ($iterator as $entry) {
					if (strpos($entry->getFilename(), $nome_tmp) !== false) {
						$this->destino = $this->pasta_usuario.$entry->getFilename();
						$this->tipo = $entry->getExtension();
						rename($entry->getPathname(), $this->destino);
					}
				}
				
				if (isset($this->tipo)) {
					return "/imagens/".$this->usuario."/".$nome_tmp."-@.".$this->tipo;
				}
			}
		}
		
		public function Arquivar_Imagem_Usuario($nome_tmp) {
        	$this->pasta_usuario = $_SERVER['DOCUMENT_ROOT']."/imagens/".$this->usuario."/";
        	$this->diretorio = $this->pasta_usuario."tmp/";
			
			if (file_exists($this->diretorio)) {
				$this->Gerenciar_Temporarios();
				
				$iterator = new DirectoryIterator($this->diretorio);
				
				foreach ($iterator as $entry) {
					if (strpos($entry->getFilename(), $nome_tmp) !== false) {
						$this->destino = $this->pasta_usuario.$entry->getFilename();
						$this->tipo = $entry->getExtension();
						rename($entry->getPathname(), $this->destino);
					}
				}
				
				if (isset($this->tipo)) {
					return "/imagens/".$this->usuario."/".$nome_tmp."-@.".$this->tipo;
				}
			}
		}
		
        public function Arquivar_Imagem_Peca($nomes_tmp, $id_peca) {
        	$this->pasta_usuario = $_SERVER['DOCUMENT_ROOT']."/imagens/".$this->usuario."/";
        	$this->diretorio = $this->pasta_usuario."tmp/";
			$this->caminho = $this->pasta_usuario.$id_peca."/";
			
			if (file_exists($this->diretorio)) {
				$this->Gerenciar_Temporarios();
				
				$imagens_peca = array();
				
	            mkdir($this->caminho, 0777, true);
	            chmod($this->caminho, 0777);
				
				$iterator = new DirectoryIterator($this->diretorio);
				
				foreach ($nomes_tmp as $nome_img) {
					foreach ($iterator as $entry) {
						if (strpos($entry->getFilename(), $nome_img) !== false) {
							$this->destino = $this->caminho.$entry->getFilename();
							$this->tipo = $entry->getExtension();
							rename($entry->getPathname(), $this->destino);
						}
					}
					
					if (isset($this->tipo)) {
						$imagens_peca[] = "/imagens/".$this->usuario."/".$id_peca."/".$nome_img."-@.".$this->tipo;
					}
				}
				
				return $imagens_peca;
			}
        }
		
		public function Deletar_Imagem_Usuario() {
			if (empty($this->pasta_usuario)) {
				$this->pasta_usuario = $_SERVER['DOCUMENT_ROOT']."/imagens/".$this->usuario."/";
			}
			
			if (file_exists($this->pasta_usuario)) {
			    $iterator = new DirectoryIterator($this->pasta_usuario);
			    
				foreach ($iterator as $entry) {
					if (strpos($entry->getFilename(), "100x75") !== false
					OR strpos($entry->getFilename(), "200x150") !== false
					OR strpos($entry->getFilename(), "320x240") !== false
					OR strpos($entry->getFilename(), "400x300") !== false
					OR strpos($entry->getFilename(), "800x600") !== false) {
						unlink($entry->getPathname());
					}
				}
			}
		}
        
		public function Deletar_Imagem_Temporaria($nome_imagem) {
			$this->diretorio = $_SERVER['DOCUMENT_ROOT']."/imagens/".$this->usuario."/tmp/";
			
			if (file_exists($this->diretorio)) {
				$this->Gerenciar_Temporarios();
				
			    $iterator = new DirectoryIterator($this->diretorio);
			    
			    foreach ($iterator as $entry) {
					if (strpos($entry->getFilename(), $nome_imagem) !== false) {
						unlink($entry->getPathname());
					}
				}
			}
		}
		
        public static function Gerar_Data_URL($imagem) {
			$tipo = pathinfo($imagem, PATHINFO_EXTENSION);
			
			if ($tipo == "jpg" OR $tipo == "jpeg" OR $tipo == "png") {
				$data = file_get_contents($imagem);
				$base64 = 'data:image/'.$tipo.';base64,'.base64_encode($data);
				return $base64;
			}
        }
		
		public function Pegar_Caminho_Por_Nome_Imagem($nome) {
			$this->diretorio = $_SERVER['DOCUMENT_ROOT']."/imagens/".$this->usuario."/tmp/";
		    
			if (file_exists($this->diretorio)) {
				$this->Gerenciar_Temporarios();
				
			    $iterator = new DirectoryIterator($this->diretorio);
			    
			    foreach ($iterator as $entry) {
					if (strpos($entry->getFilename(), $nome) !== false) {
						return $entry->getPathname();
					}
			    }
			}
		}
		
		private function Validar_Imagem() {
			if ($this->tipo == "image" AND ($this->extensao == "jpg" OR $this->extensao == "jpeg" OR $this->extensao == "png")) {
				return true;
			} else {
				return false;
			}
		}
		
		private function Redimencionar_Imagem($largura_padrao, $altura_padrao, $imagem_tmp) {
            $nova_largura;
            $nova_altura;
			
			list($largura, $altura) = getimagesize($imagem_tmp);
         	
            if(($largura > $largura_padrao) OR ($altura > $altura_padrao)) {
                if ($largura > $altura) {
                    $nova_largura = $largura_padrao; 
                    $nova_altura = round(($nova_largura / $largura) * $altura);
                } else if ($altura > $largura) {
                    $nova_altura = $altura_padrao; 
                    $nova_largura = round(($nova_altura / $altura) * $largura);
                } else {
                    $nova_altura = $nova_largura = max($largura_padrao, $altura_padrao);
                }
                
                $nova_imagem = imagecreatetruecolor($nova_largura, $nova_altura);
                $fundo = imagecreatetruecolor($largura_padrao, $altura_padrao);
				
                switch ($this->extensao) {
                    case "jpeg":
						$this->destino = $this->caminho."-".$largura_padrao."x".$altura_padrao.".".$this->extensao;
                        $origem = imagecreatefromjpeg($imagem_tmp);
                        imagecopyresampled($nova_imagem, $origem, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura, $altura);
                        imagecopy($fundo, $nova_imagem, (($largura_padrao - $nova_largura) / 2), (($altura_padrao - $nova_altura) / 2), 0, 0, $nova_largura, $nova_altura);
                        imagejpeg($fundo, $this->destino, 100);
                        break;
                        
                    case "png":
						$this->destino = $this->caminho."-".$largura_padrao."x".$altura_padrao.".".$this->extensao;
                        $origem = imagecreatefrompng($imagem_tmp);
                        imagecopyresampled($nova_imagem, $origem, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura, $altura);
                        imagecopy($fundo, $nova_imagem, (($largura_padrao - $nova_largura) / 2), (($altura_padrao - $nova_altura) / 2), 0, 0, $nova_largura, $nova_altura);
                        imagepng($fundo, $destino);
                        break;
				}
                
                imagedestroy($nova_imagem);
                imagedestroy($origem);
                imagedestroy($fundo);
                
                chmod($this->destino, 0777);
            }
		}
		
		private function Gerenciar_Temporarios() {
		    $iterator = new DirectoryIterator($this->diretorio);
		    
		    foreach ($iterator as $entry) {
				$tempo = filemtime($entry->getPathname());
				$agora = time();
				
				if(($agora - $tempo) >= 1800) {
					if (file_exists($entry->getPathname())) {
						if (!is_dir($entry->getPathname())) {
							unlink($entry->getPathname());
						}
					}
				}
		    }
		}
	}
?>