<?php
namespace Module\Application\Model\Validador;
    
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    Use Module\Application\Model\Common\Util\Login_Session;
    use \Exception;
    
    class Peca
    {
        function __constructor()
        {
            
        }
        
        public static function validar_id($id = null) : int
        {
            if (!empty($id)) {
                if (filter_var($id, FILTER_VALIDATE_INT) !== false) {
                    return $id;
                } else {
                    throw new Exception('Id da peça inválido');
                }
            } else {
                throw new Exception('Id da peça não informado');
            }
        }
        
        public static function validar_entidade($entidade = null) : void
        {
            
        }
        
        public static function validar_responsavel($usuario_responsavel = null) : int
        {
            if (!empty($usuario_responsavel)) {
                if (filter_var($usuario_responsavel, FILTER_VALIDATE_INT) !== false) {
                    return $usuario_responsavel;
                } else {
                    throw new Exception('Usuario responsavel inválido');
                }
            } else {
                throw new Exception('Usuario responsavel não informado');
            }
        }
        
        public static function validar_nome($nome = null) : string
        {
            if (!empty($nome)) {
                $valor = strip_tags($nome);
                
                if ($valor === $nome) {
                    $nome = trim($nome);
                    $nome = preg_replace('/\s+/', " ", $nome);
                    
                    if (strlen($nome) <= 100) {
                        return ucwords(strtolower($nome));
                    } else {
                        throw new Exception('Peça Nome, não pode conter mais de 100 caracteres');
                    }
                } else {
                    throw new Exception('Peça Nome, não pode conter tags de programação');
                }
            } else {
                throw new Exception('Digite o nome da peça');
            }
        }
        
        public static function validar_url($url = null) : string
        {
            if (!empty($url)) {
                $valor = strip_tags($url);
                
                if ($valor === $url) {
                    $url = trim($url);
                    $url = preg_replace('/\s+/', " ", $url);
                    
                    if (strlen($url) <= 150) {
                        return ucwords(strtolower($url));
                    } else {
                        throw new Exception('Peça URL, não pode conter mais de 150 caracteres');
                    }
                } else {
                    throw new Exception('Peça URL, não pode conter tags de programação');
                }
            } else {
                throw new Exception('Informa a URL da peça');
            }
        }
        
        public static function validar_fabricante($fabricante = null) : ?string
        {
            if (!empty($fabricante)) {
                $valor = strip_tags($fabricante);
                
                if ($valor === $fabricante) {
                    $fabricante = trim($fabricante);
                    $fabricante = preg_replace('/\s+/', " ", $fabricante);
                    
                    if (strlen($fabricante) <= 50) {
                        return ucwords(strtolower($fabricante));
                    } else {
                        throw new Exception('Fabricante, não pode conter mais de 50 caracteres');
                    }
                } else {
                    throw new Exception('Fabricante, não pode conter tags de programação');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_serie($serie = null) : ?string
        {
            if (!empty($serie)) {
                $valor = strip_tags($serie);
                
                if ($valor=== $serie) {
                    $serie = trim($serie);
                    $serie = preg_replace('/\s+/', " ", $serie);
                    
                    if (strlen($serie) <= 150) {
                        return $serie;
                    } else {
                        throw new Exception('Numero de Serie, não pode conter mais de 150 caracteres');
                    }
                } else {
                    throw new Exception('Numero de Serie, não pode conter tags de programação');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_endereco($endereco = null) : void
        {
            
        }
        
        public static function validar_preco($preco = null) : ?float
        {
            if (!empty($preco)) {
                $preco = str_replace('.', '', $preco);
                $preco = (float) str_replace(',', '.', $preco);
                
                if (filter_var($preco, FILTER_VALIDATE_FLOAT) !== false) {
                    return $preco;
                } else {
                    throw new Exception('Digite um preço válido para a peça');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_ordem_preco($ordem_preco = null) : ?string
        {
            if (!empty($ordem_preco)) {
                $valor = strip_tags($ordem_preco);
                
                if ($valor === $ordem_preco) {
                    $ordem_preco = trim($ordem_preco);
                    
                    return strtolower($ordem_preco);
                } else {
                    throw new Exception('Ordem do Preço, não pode conter tags de programação');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_data_anuncio($data_anuncio = null) : void
        {
            
        }
        
        public static function validar_ordem_data($ordem_data) : ?string
        {
            if (!empty($ordem_data)) {
                $valor = strip_tags($ordem_data);
                
                if ($valor === $ordem_data) {
                    $ordem_data = trim($ordem_data);
                    
                    return strtolower($ordem_data);
                } else {
                    throw new Exception('Ordem da Data, não pode conter tags de programação');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_descricao($descricao = null) : ?string
        {
            if (!empty($descricao)) {
                $valor = strip_tags($descricao);
                
                if ($valor === $descricao) {
                    $descricao = trim($descricao);
                    $descricao = preg_replace('/\s+/', " ", $descricao);
                    
                    if (strlen($descricao) <= 1000) {
                        return ucfirst($descricao);
                    } else {
                        throw new Exception('Descricao, não pode conter mais de 1000 caracteres');
                    }
                } else {
                    throw new Exception('Descricao, não pode conter tags de programação');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_prioridade($prioridade = null) : ?bool
        {
            if (!empty($prioridade)) {
                return true;
            } else {
                return null;
            }
        }
        
        public static function validar_status($status = null) : ?int
        {
            if (!empty($status)) {
                if (filter_var($status, FILTER_VALIDATE_INT)) {
                    return $status;
                } else {
                    throw new Exception('Selecione um status válido.');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_estado_uso($estado_uso = null) : ?int
        {
            if (!empty($estado_uso)) {
                if (filter_var($estado_uso, FILTER_VALIDATE_INT)) {
                    return $estado_uso;
                } else {
                    throw new Exception('Selecione um estado de uso válido.');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_fotos($fotos = null) : void
        {
            
        }
        
        public static function validar_foto($foto = null) : void
        {
            
        }
        
        public static function validar_num_visualizado($num_visualizado = null) : ?int
        {
            if (!empty($num_visualizado)) {
                if (filter_var($num_visualizado, FILTER_VALIDATE_INT)) {
                    return $num_visualizado;
                } else {
                    throw new Exception('Numero de visualizações inválido.');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_preferencia_entrega($preferencia_entrega = null) : ?int
        {
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
        
        public static function validar_pesquisa($pesquisa = null) : ?string
        {
            if (!empty($pesquisa)) {
                $pesquisa = trim($pesquisa);
                
                if (strip_tags($pesquisa) === $pesquisa) {
                    return $pesquisa;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        
        /**
         * Valida o parametro bool para se e vip, e o segundo parametro sempre para verificar se a peça já é vip,
         * Se for, nesse caso ele tem que permitir atualizar mesmo já tendo atingido o limite de peças vip.
         * 
         * @param bool $vip
         * @param int $peca_id
         * @throws Exception
         * @return bool
         */
        public static function validar_vip($vip = null, $peca_id = null) : bool
        {
            if (!empty($vip) || $vip != false) {
                $limite_vip = DAO_Plano::BuscarLimitePecasVipPorId(Login_Session::get_entidade_plano());
                
                if ($limite_vip >= 1) {
                    $peca_vip = false;
                    
                    if (!empty($peca_id)) {
                        $peca_vip = DAO_Peca::BuscarVipPorPeca($peca_id);
                    }
                    
                    $anuncios_vip = DAO_Peca::BuscarNumVipPorEntidade(Login_Session::get_entidade_id(), true);
                    
                    if ($anuncios_vip < $limite_vip || $peca_vip) {
                        return true;
                    } else {
                        throw new Exception("Você atingiu o limite máximo de anúncios com destaque. Seu plano atual permite cadastrar $limite_vip anúncios Vip");
                    }
                } else {
                    throw new Exception('Seu plano atual não permite anúncios Vip. Você pode migrar para um plano superior acessando: <a href="/usuario/meu-perfil/financeiro/meu-plano/">Meu-Plano</a>');
                }
            } else {
                return false;
            }
        }
        
        public static function filtrar_pesquisa($pesquisa = null) : ?string
        {
            $valor = null;
            
            if (!empty($pesquisa)) {
                $valor = trim(strip_tags($pesquisa));
            }
            
            return $valor;
        }
        
        public static function filtrar_id($id = null) : ?int
        {
            $valor = null;
            
            if (!empty($id) AND filter_var($id, FILTER_VALIDATE_INT)) {
                $valor = trim($id);
            }
            
            return $valor;
        }
        
        public static function filtrar_entidade($entidade = null) : void
        {
            
        }
        
        public static function filtrar_responsavel($usuario_responsavel = null) : ?int
        {
            $valor = null;
            
            if (!empty($usuario_responsavel) AND filter_var($usuario_responsavel, FILTER_VALIDATE_INT)) {
                $valor = trim($usuario_responsavel);
            }
            
            return $valor;
        }
        
        public static function filtrar_nome($nome = null) : string
        {
            $valor = "";
            
            if (!empty($nome)) {
                $valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($nome)))));
            }
            
            return $valor;
        }
        
        public static function filtrar_url($url = null) : string
        {
            $valor = "";
            
            if (!empty($url)) {
                $valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($url)))));
            }
            
            return $valor;
        }
        
        public static function filtrar_fabricante($fabricante = null) : ?string
        {
            $valor = null;
            
            if (!empty($fabricante)) {
                $valor = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($fabricante)))));
            }
            
            return $valor;
        }
        
        public static function filtrar_serie($serie = null) : ?string
        {
            $valor = null;
            
            if (!empty($serie)) {
                $valor = trim(strip_tags($serie));
            }
            
            return $valor;
        }
        
        public static function filtrar_endereco($endereco = null) : void
        {
            
        }
        
        public static function filtrar_preco($preco = null) : ?float
        {
            $valor = null;
            
            if (!empty($preco) AND filter_var($preco, FILTER_VALIDATE_FLOAT)) {
                $valor = trim($preco);
            }
            
            return $valor;
        }
        
        public static function filtrar_ordem_preco($ordem_preco = null) : ?string
        {
            
        }
        
        public static function filtrar_data_anuncio($data_anuncio = null) : void
        {
            
        }
        
        public static function filtrar_ordem_data($ordem_data)
        {
            
        }
        
        public static function filtrar_descricao($descricao = null) : ?string
        {
            $valor = null;
            
            if (!empty($descricao)) {
                $valor = ucfirst(preg_replace('/\s+/', " ", trim(strip_tags($descricao))));
            }
            
            return $valor;
        }
        
        public static function filtrar_prioridade($prioridade = null) : ?bool
        {
            $valor = null;
            
            if (!empty($prioridade)) {
                $valor = true;
            }
            
            return $valor;
        }
        
        public static function filtrar_status($status = null) : ?int
        {
            $valor = null;
            
            if (!empty($status) AND filter_var($status, FILTER_VALIDATE_INT)) {
                $valor = trim($status);
            }
            
            return $valor;
        }
        
        public static function filtrar_estado_uso($estado_usp = null) : ?int
        {
            $valor = null;
            
            if (!empty($estado_uso) AND filter_var($estado_uso, FILTER_VALIDATE_INT)) {
                $valor = trim($estado_uso);
            }
            
            return $valor;
        }
        
        public static function filtrar_fotos($fotos = null) : void
        {
            
        }
        
        public static function filtrar_foto($foto = null) : void
        {
            
        }
        
        public static function filtrar_num_visualizado($num_visualizado = null) : ?int
        {
            $valor = null;
            
            if (!empty($num_visualizado) AND filter_var($num_visualizado, FILTER_VALIDATE_INT)) {
                $valor = trim($num_visualizado);
            }
            
            return $valor;
        }
        
        public static function filtrar_preferencia_entrega($preferencia_entrega = null) : void
        {
            
        }
        
        public static function filtrar_vip($vip = null) : bool
        {
            if ($vip === true) {
                return true;
            } else {
                return false;
            }
        }
    }
