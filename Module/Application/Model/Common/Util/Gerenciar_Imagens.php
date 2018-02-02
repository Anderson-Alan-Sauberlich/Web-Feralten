<?php
namespace Module\Application\Model\Common\Util;
    
    //use Module\Application\Model\Common\Util\Login_Session;
    use DirectoryIterator;
    
    class Gerenciar_Imagens
    {
        function __construct()
        {
            $this->usuario = Login_Session::get_usuario_id();
            $this->entidade = Login_Session::get_entidade_id();
        }
        
        private $caminho;
        private $extensao;
        private $diretorio;
        private $destino;
        private $tipo;
        private $nome;
        private $usuario;
        private $entidade;
        private $pasta_entidade;
        private $pasta_usuario;
        
        public function get_nome()
        {
            return $this->nome;
        }
        
        public function get_caminho()
        {
            return $this->caminho;
        }
        
        public function get_extensao()
        {
            return $this->extensao;
        }
        
        public function get_diretorio()
        {
            return $this->diretorio;
        }
        
        public function get_destino()
        {
            return $this->destino;
        }
        
        public function get_tipo()
        {
            return $this->tipo;
        }
        
        public function Armazenar_Imagem_Temporaria($arquivo)
        {
            $info = explode('/', $arquivo['type']);
            
            $this->tipo = $info[0];
            $this->extensao = $info[1];
            
            $this->pasta_entidade = RAIZ.'/public/imagens/'.$this->entidade.'/';
            $this->diretorio = $this->pasta_entidade.'tmp/';
            
            if (file_exists($this->pasta_entidade)) {
                if (!file_exists($this->diretorio)) {
                    mkdir($this->diretorio, 0777, true);
                    chmod($this->diretorio, 0777);
                }
            } else {
                mkdir($this->pasta_entidade, 0777, true);
                chmod($this->pasta_entidade, 0777);
                mkdir($this->diretorio, 0777, true);
                chmod($this->diretorio, 0777);
            }
                        
            $this->Gerenciar_Temporarios();
            
            if ($this->Validar_Imagem()) {
                $this->nome = str_replace('.', '', uniqid('img_tmp_'.rand(10, 99), true));
                
                $this->caminho = $this->diretorio.$this->nome;
                
                $imagem_tmp = $this->caminho.'.'.$this->extensao;
                
                move_uploaded_file($arquivo['tmp_name'], $imagem_tmp);
                
                $this->Redimencionar_Imagem(800, 600, $imagem_tmp);
                $this->Redimencionar_Imagem(600, 450, $imagem_tmp);
                $this->Redimencionar_Imagem(400, 300, $imagem_tmp);
                $this->Redimencionar_Imagem(320, 240, $imagem_tmp);
                $this->Redimencionar_Imagem(200, 150, $imagem_tmp);
                $this->Redimencionar_Imagem(100, 75, $imagem_tmp);
                
                unlink($imagem_tmp);
            } else if (!empty($this->extensao) AND !empty($this->tipo)) {
                return 'O Arquivo selecionado não é uma imagem Valida';
            }
        }

        public function Atualizar_Imagem_Entidade($nome_tmp, ?string $descricao = 'tmp') : ?string
        {
            $this->pasta_entidade = RAIZ.'/public/imagens/'.$this->entidade.'/';
            $this->diretorio = $this->pasta_entidade.'tmp/';

            $this->Deletar_Imagem_Entidade();
            
            if (file_exists($this->diretorio)) {
                $this->Gerenciar_Temporarios();
                
                $iterator = new DirectoryIterator($this->diretorio);
                
                foreach ($iterator as $entry) {
                    if (strpos($entry->getFilename(), $nome_tmp) !== false) {
                        $this->destino = $this->pasta_entidade.str_replace('img_tmp_', 'img_'.$descricao.'_', $entry->getFilename());
                        $this->tipo = $entry->getExtension();
                        rename($entry->getPathname(), $this->destino);
                    }
                }
                
                if (!empty($this->tipo)) {
                    $nome_tmp = str_replace('img_tmp_', 'img_'.$descricao.'_', $nome_tmp);
                    return '/imagens/'.$this->entidade.'/'.$nome_tmp.'-@.'.$this->tipo;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        
        public function Atualizar_Nome_Imagem_Entidade(?string $descricao = 'tmp') : ?string
        {
            $this->pasta_entidade = RAIZ.'/public/imagens/'.$this->entidade.'/';
            
            if (file_exists($this->pasta_entidade)) {
                $iterator = new DirectoryIterator($this->pasta_entidade);
                
                foreach ($iterator as $entry) {
                    $this->nome = preg_replace('/_(.*?)_/', '_'.$descricao.'_', $entry->getFilename());
                    $this->destino = $this->pasta_entidade.$this->nome;
                    
                    if ($entry->getExtension() == 'jpg' OR $entry->getExtension() == 'jpeg' OR $entry->getExtension() == 'png') {
                        rename($entry->getPathname(), $this->destino);
                    }
                }
                
                if (!empty($this->nome)) {
                    $this->nome = str_replace('800x600', '@', $this->nome);
                    $this->nome = str_replace('600x450', '@', $this->nome);
                    $this->nome = str_replace('400x300', '@', $this->nome);
                    $this->nome = str_replace('320x240', '@', $this->nome);
                    $this->nome = str_replace('200x150', '@', $this->nome);
                    $this->nome = str_replace('100x75', '@', $this->nome);
                    
                    return '/imagens/'.$this->entidade.'/'.$this->nome;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        
        public function Arquivar_Imagem_Entidade($nome_tmp, ?string $descricao = 'tmp') : ?string
        {
            $this->pasta_entidade = RAIZ.'/public/imagens/'.$this->entidade.'/';
            $this->diretorio = RAIZ.'/public/imagens/tmp/';
            
            if (file_exists($this->diretorio)) {
                $this->Gerenciar_Temporarios();
                
                if (!file_exists($this->pasta_entidade)) {
                    mkdir($this->pasta_entidade, 0777, true);
                    chmod($this->pasta_entidade, 0777);
                }
                
                $iterator = new DirectoryIterator($this->diretorio);
                
                foreach ($iterator as $entry) {
                    if (strpos($entry->getFilename(), $nome_tmp) !== false) {
                        $this->destino = $this->pasta_entidade.str_replace('img_tmp_', 'img_'.$descricao.'_', $entry->getFilename());
                        $this->tipo = $entry->getExtension();
                        rename($entry->getPathname(), $this->destino);
                    }
                }
                
                if (!empty($this->tipo)) {
                    $nome_tmp = str_replace('img_tmp_', 'img_'.$descricao.'_', $nome_tmp);
                    return '/imagens/'.$this->entidade.'/'.$nome_tmp.'-@.'.$this->tipo;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        
        public function Atualizar_Imagem_Peca(?array $nomes_tmp, ?int $id_peca) : ?array
        {
            $this->pasta_entidade = RAIZ.'/public/imagens/'.$this->entidade.'/';
            $this->diretorio = $this->pasta_entidade.'tmp/';
            $this->caminho = $this->pasta_entidade.$id_peca.'/';
            
            if (file_exists($this->diretorio)) {
                if (!file_exists($this->caminho)) {
                    mkdir($this->caminho, 0777, true);
                    chmod($this->caminho, 0777);
                }
                
                $this->Gerenciar_Temporarios();
                
                $imagens_peca = array();
                
                $iterator = new DirectoryIterator($this->diretorio);
                
                foreach ($nomes_tmp as $key => $nome_img) {
                    foreach ($iterator as $entry) {
                        if (strpos($entry->getFilename(), $nome_img) !== false) {
                            $this->destino = $this->caminho.$entry->getFilename();
                            $this->tipo = $entry->getExtension();
                            rename($entry->getPathname(), $this->destino);
                        }
                    }
                    
                    if (!empty($this->tipo)) {
                        if (!empty($key)) {
                            $imagens_peca[$key] = '/imagens/'.$this->entidade.'/'.$id_peca.'/'.$nome_img.'-@.'.$this->tipo;
                        }
                    }
                }
                
                return $imagens_peca;
            } else {
                return null;
            }
        }
        
        public function Atualizar_Nome_Imagem_Peca(int $peca, ?string $descricao = 'tmp') : bool
        {
            $this->diretorio = RAIZ.'/public/imagens/'.$this->entidade.'/'.$peca.'/';
            
            if (file_exists($this->diretorio)) {
                $iterator = new DirectoryIterator($this->diretorio);
                
                foreach ($iterator as $entry) {
                    $this->nome = preg_replace('/_(.*?)_/', '_'.$descricao.'_', $entry->getFilename());
                    $this->destino = $this->diretorio.$this->nome;
                    
                    if ($entry->getExtension() == 'jpg' OR $entry->getExtension() == 'jpeg' OR $entry->getExtension() == 'png') {
                        rename($entry->getPathname(), $this->destino);
                    }
                }
                
                if (!empty($this->nome)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        public function Arquivar_Imagem_Peca(?array $nomes_tmp, ?int $id_peca, ?string $descricao = 'tmp') : ?array
        {
            $this->pasta_entidade = RAIZ.'/public/imagens/'.$this->entidade.'/';
            $this->diretorio = $this->pasta_entidade.'tmp/';
            $this->caminho = $this->pasta_entidade.$id_peca.'/';
            
            if (file_exists($this->diretorio)) {
                $this->Gerenciar_Temporarios();
                
                $imagens_peca = array();
                
                if (!file_exists($this->caminho)) {
                    mkdir($this->caminho, 0777, true);
                    chmod($this->caminho, 0777);
                }
                
                $iterator = new DirectoryIterator($this->diretorio);
                
                foreach ($nomes_tmp as $key => $nome_tmp) {
                    foreach ($iterator as $entry) {
                        if (strpos($entry->getFilename(), $nome_tmp) !== false) {
                            $this->destino = $this->caminho.str_replace('img_tmp_', 'img_'.$descricao.'_', $entry->getFilename());
                            $this->tipo = $entry->getExtension();
                            rename($entry->getPathname(), $this->destino);
                        }
                    }
                    
                    if (!empty($this->tipo)) {
                        if (!empty($key)) {
                            $nome_tmp = str_replace('img_tmp_', 'img_'.$descricao.'_', $nome_tmp);
                            $imagens_peca[$key] = '/imagens/'.$this->entidade.'/'.$id_peca.'/'.$nome_tmp.'-@.'.$this->tipo;
                        }
                    }
                }
                
                return $imagens_peca;
            } else {
                return null;
            }
        }
        
        public function Deletar_Imagem_Entidade()
        {
            if (empty($this->pasta_entidade)) {
                $this->pasta_entidade = RAIZ.'/public/imagens/'.$this->entidade."/";
            }
            
            if (file_exists($this->pasta_entidade)) {
                $iterator = new DirectoryIterator($this->pasta_entidade);
                
                foreach ($iterator as $entry) {
                    if (strpos($entry->getFilename(), '100x75') !== false
                    OR strpos($entry->getFilename(), '200x150') !== false
                    OR strpos($entry->getFilename(), '320x240') !== false
                    OR strpos($entry->getFilename(), '400x300') !== false
                    OR strpos($entry->getFilename(), '600x450') !== false
                    OR strpos($entry->getFilename(), '800x600') !== false) {
                        unlink($entry->getPathname());
                    }
                }
            }
        }
        
        public function Deletar_Imagens_Peca(int $peca_id, int $entidade_id) : bool
        {
            $endereco = RAIZ."/public/imagens/$entidade_id/$peca_id/";
            
            if (is_dir($endereco)) {
                return self::delTree($endereco);
            } else {
                return false;
            }
        }
        
        public function Deletar_Imagem_Peca(string $endereco) : bool
        {
            $resposta = true;
            $endereco = RAIZ."/public/$endereco";
            
            $imagem1 = str_replace('@', '100x75', $endereco);
            $imagem2 = str_replace('@', '200x150', $endereco);
            $imagem3 = str_replace('@', '320x240', $endereco);
            $imagem4 = str_replace('@', '400x300', $endereco);
            $imagem5 = str_replace('@', '600x450', $endereco);
            $imagem6 = str_replace('@', '800x600', $endereco);
            
            if (file_exists($imagem1)) {
                if (unlink($imagem1) !== true) {
                    $resposta = false;
                }
            }
            
            if (file_exists($imagem2)) {
                if (unlink($imagem2) !== true) {
                    $resposta = false;
                }
            }
            
            if (file_exists($imagem3)) {
                if (unlink($imagem3) !== true) {
                    $resposta = false;
                }
            }
            
            if (file_exists($imagem4)) {
                if (unlink($imagem4) !== true) {
                    $resposta = false;
                }
            }
            
            if (file_exists($imagem5)) {
                if (unlink($imagem5) !== true) {
                    $resposta = false;
                }
            }
            
            if (file_exists($imagem6)) {
                if (unlink($imagem6) !== true) {
                    $resposta = false;
                }
            }
            
            return $resposta;
        }
        
        public function Deletar_Imagem_Temporaria($nome_imagem)
        {
            $this->diretorio = RAIZ.'/public/imagens/'.$this->entidade.'/tmp/';
            
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
        
        public static function Gerar_Data_URL($imagem)
        {
            $tipo = pathinfo($imagem, PATHINFO_EXTENSION);
            
            if ($tipo == 'jpg' OR $tipo == 'jpeg' OR $tipo == 'png') {
                $data = file_get_contents($imagem);
                $base64 = 'data:image/'.$tipo.';base64,'.base64_encode($data);
                return $base64;
            }
        }
        
        public function Pegar_Caminho_Por_Nome_Imagem_TMP(string $nome) : ?string
        {
            $this->diretorio = RAIZ.'/public/imagens/'.$this->entidade.'/tmp/';
            
            if (file_exists($this->diretorio)) {
                $this->Gerenciar_Temporarios();
                
                $imagem = null;
                
                $iterator = new DirectoryIterator($this->diretorio);
                
                foreach ($iterator as $entry) {
                    if (strpos($entry->getFilename(), $nome) !== false) {
                        $imagem = $entry->getPathname();
                    }
                }
                
                return $imagem;
            } else {
                return null;
            }
        }
        
        public function Pegar_Caminho_Por_Nome_Imagem_CNST(string $nome, int $peca) : ?string
        {
            $this->diretorio = RAIZ.'/public/imagens/'.$this->entidade.'/'.$peca;
            
            if (file_exists($this->diretorio)) {                
                $imagem = null;
                $iterator = new DirectoryIterator($this->diretorio);
                
                foreach ($iterator as $entry) {
                    if (strpos($entry->getFilename(), $nome) !== false) {
                        $imagem = $entry->getPathname();
                    }
                }
                
                return $imagem;
            } else {
                return null;
            }
        }
        
        private function Validar_Imagem()
        {
            if ($this->tipo == 'image' AND ($this->extensao == 'jpg' OR $this->extensao == 'jpeg' OR $this->extensao == 'png')) {
                return true;
            } else {
                return false;
            }
        }
        
        private function Redimencionar_Imagem($largura_padrao, $altura_padrao, $imagem_tmp)
        {
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
                    case 'jpeg':
                        $this->destino = $this->caminho.'-'.$largura_padrao.'x'.$altura_padrao.'.'.$this->extensao;
                        $origem = imagecreatefromjpeg($imagem_tmp);
                        imagecopyresampled($nova_imagem, $origem, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura, $altura);
                        imagecopy($fundo, $nova_imagem, (($largura_padrao - $nova_largura) / 2), (($altura_padrao - $nova_altura) / 2), 0, 0, $nova_largura, $nova_altura);
                        imagejpeg($fundo, $this->destino, 100);
                        break;
                        
                    case 'png':
                        $this->destino = $this->caminho.'-'.$largura_padrao.'x'.$altura_padrao.'.'.$this->extensao;
                        $origem = imagecreatefrompng($imagem_tmp);
                        imagecopyresampled($nova_imagem, $origem, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura, $altura);
                        imagecopy($fundo, $nova_imagem, (($largura_padrao - $nova_largura) / 2), (($altura_padrao - $nova_altura) / 2), 0, 0, $nova_largura, $nova_altura);
                        imagepng($fundo, $this->destino);
                        break;
                }
                
                imagedestroy($nova_imagem);
                imagedestroy($origem);
                imagedestroy($fundo);
                
                chmod($this->destino, 0777);
            }
        }
        
        private function Gerenciar_Temporarios()
        {
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
        
        private static function delTree(string $dir) : bool
        {
            $files = array_diff(scandir($dir), array('.','..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        }
    }
