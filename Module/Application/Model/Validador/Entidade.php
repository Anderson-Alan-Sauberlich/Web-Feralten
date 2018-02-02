<?php
namespace Module\Application\Model\Validador;
    
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\CPF_CNPJ;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use \Exception;
    
    class Entidade
    {
        function __constructor()
        {
            
        }
        
        public static function validar_id($id = null) : int
        {
            
        }
        
        public static function validar_usuario_id($usuario_id = null) : int
        {
            
        }
        
        public static function validar_status_id($status_id = null) : int
        {
            
        }
        
        public static function validar_cpf_cnpj($cpf_cnpj = null) : string
        {
            if (empty($cpf_cnpj)) {
                throw new Exception('Informe seu CPF ou CNPJ');
            } else {
                $cpf_cnpj = trim($cpf_cnpj);
                $cpf_cnpj = preg_replace('/[^a-zA-Z0-9]/', "", $cpf_cnpj);
                
                if (filter_var($cpf_cnpj, FILTER_VALIDATE_FLOAT) !== false) {
                    if (strlen($cpf_cnpj) === 11 OR strlen($cpf_cnpj) === 14) {
                        $class_cpf_cnpj = new CPF_CNPJ($cpf_cnpj);
                        
                        if ($class_cpf_cnpj->valida()) {
                            return $cpf_cnpj;
                        } else {
                            throw new Exception('CPF/CNPJ Inválido');
                        }
                    } else {
                        throw new Exception('CPF/CNPJ, Deve Conter Exatos 11 ou 14 Caracteres');
                    }
                } else {
                    throw new Exception('CPF/CNPJ, Digite Apenas Numeros');
                }
            }
        }
        
        public static function validar_cpf_cnpj_unico($cpf_cnpj = null) : string
        {
            if (empty($cpf_cnpj)) {
                throw new Exception('Informe seu CPF ou CNPJ');
            } else {
                $cpf_cnpj = trim($cpf_cnpj);
                $cpf_cnpj = preg_replace('/[^a-zA-Z0-9]/', "", $cpf_cnpj);
                
                if (filter_var($cpf_cnpj, FILTER_VALIDATE_FLOAT) !== false) {
                    if (strlen($cpf_cnpj) === 11 OR strlen($cpf_cnpj) === 14) {
                        $class_cpf_cnpj = new CPF_CNPJ($cpf_cnpj);
                        
                        if ($class_cpf_cnpj->valida()) {
                            $retorno = DAO_Entidade::Verificar_CPF_CNPJ($cpf_cnpj);
                            
                            if ($retorno !== false) {
                                if ($retorno === 0 OR $retorno == Login_Session::get_entidade_id()) {
                                    return $cpf_cnpj;
                                } else {
                                    throw new Exception('Este CPF/CNPJ já esta Cadastrado');
                                }
                            } else {
                                throw new Exception('Erro ao tentar Encontrar CPF/CNPJ');
                            }
                        } else {
                            throw new Exception('CPF/CNPJ Inválido');
                        }
                    } else {
                        throw new Exception('CPF/CNPJ, Deve Conter Exatos 11 ou 14 Caracteres');
                    }
                } else {
                    throw new Exception('CPF/CNPJ, Digite Apenas Numeros');
                }
            }
        }
        
        public static function validar_nome_comercial($nome_comercial = null) : ?string
        {
            if (!empty($nome_comercial)) {
                $valor = strip_tags($nome_comercial);
                
                if ($valor === $nome_comercial) {
                    $nome_comercial = trim($nome_comercial);
                    $nome_comercial = preg_replace('/\s+/', " ", $nome_comercial);
                    
                    if (strlen($nome_comercial) <= 50) {
                        return $nome_comercial;
                    } else {
                        throw new Exception('Nome Comercial, Não pode conter mais de 50 Caracteres');
                    }
                } else {
                    throw new Exception('Nome Comercial, Não pode conter Tags de Programação');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_imagem($imagem = null) : void
        {
            
        }
        
        public static function validar_descricao_imagem($img_descricao = null) : ?string
        {
            
        }
        
        public static function validar_site($site = null) : ?string
        {
            if (!empty($site)) {
                $valor = strip_tags($site);
                
                if ($valor === $site) {
                    $site = trim($site);
                    $site = preg_replace('/\s+/', "", $site);
                    
                    if (strlen($site) <= 150) {
                        return $site;
                    } else {
                        throw new Exception('Site, pode ter no Maximo 150 Caracteres');
                    }
                } else {
                    throw new Exception('Site, Não pode conter Tags de Programação');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_data($data = null) : void
        {
            
        }
        
        public static function validar_enderecos($enderecos = null) : void
        {
            
        }
        
        public static function validar_endereco($endereco = null) : void
        {
            
        }
        
        public static function validar_plano_id($plano_id = null) : void
        {
            
        }
        
        public static function validar_intervalo_pagamento_id($intervalo_pagamento_id = null) : void
        {
            
        }
        
        public static function validar_data_contratacao_plano($data_contratacao_plano = null) : void
        {
            
        }
        
        public static function filtrar_id($id = null) : void
        {
            
        }
        
        public static function filtrar_usuario_id($usuario_id = null) : void
        {
            
        }
        
        public static function filtrar_status_id($status_id = null) : void
        {
            
        }
        
        public static function filtrar_cpf_cnpj($cpf_cnpj = null) : string
        {
            $valor = "";
            
            if (!empty($cpf_cnpj)) {
                $valor = trim(strip_tags($cpf_cnpj));
            }
            
            return $valor;
        }
        
        public static function filtrar_nome_comercial($nome_comercial = null) : ?string
        {
            $valor = null;
            
            if (!empty($nome_comercial)) {
                $valor = trim(strip_tags($nome_comercial));
            }
            
            return $valor;
        }
        
        public static function filtrar_imagem($imagem = null) : void
        {
            
        }
        
        public static function filtrar_descricao_imagem($img_descricao = null) : ?string
        {
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
        
        public static function filtrar_site($site = null) : ?string
        {
            $valor = null;
            
            if (!empty($site)) {
                $valor = trim(strip_tags($site));
            }
            
            return $valor;
        }
        
        public static function filtrar_data($data = null) : void
        {
            
        }
        
        public static function filtrar_enderecos($enderecos = null) : void
        {
            
        }
        
        public static function filtrar_endereco($endereco = null) : void
        {
            
        }
        
        public static function filtrar_plano_id($plano_id = null) : void
        {
            
        }
        
        public static function filtrar_intervalo_pagamento_id($intervalo_pagamento_id = null) : void
        {
            
        }
        
        public static function filtrar_data_contratacao_plano($data_contratacao_plano = null) : void
        {
            
        }
    }
