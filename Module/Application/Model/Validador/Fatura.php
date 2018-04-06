<?php
namespace Module\Application\Model\Validador;
    
    use Module\Application\Model\Common\Util\CPF_CNPJ;
    use \Exception;
    
    class Fatura
    {
        function __constructor()
        {
            
        }
        
        public static function validar_token($token = null) : string
        {
            if (!empty($token)) {
                $valor = strip_tags($token);
                
                if ($valor === $token) {
                    $token = trim($token);
                    $token = preg_replace('/\s+/', " ", $token);
                    
                    if (strlen($token) <= 100) {
                        return $token;
                    } else {
                        throw new Exception('Token do Cartão de Credito, Não pode conter mais de 100 Caracteres');
                    }
                } else {
                    throw new Exception('Token do Cartão de Credito, Não pode conter Tags de Programação');
                }
            } else {
                throw new Exception('Token do Cartão de Credito não presente');
            }
        }
        
        public static function validar_hash($hash = null) : string
        {
            if (!empty($hash)) {
                $valor = strip_tags($hash);
                
                if ($valor === $hash) {
                    $hash = trim($hash);
                    $hash = preg_replace('/\s+/', " ", $hash);
                    
                    if (strlen($hash) <= 100) {
                        return $hash;
                    } else {
                        throw new Exception('Hash do usuário, Não pode conter mais de 100 Caracteres');
                    }
                } else {
                    throw new Exception('Hash do usuário, Não pode conter Tags de Programação');
                }
            } else {
                throw new Exception('Hash do usuário não presente');
            }
        }
        
        public static function validar_ip($ip = null) : string
        {
            if (!empty($ip)) {
                $valor = strip_tags($ip);
                
                if ($valor === $ip) {
                    $ip = trim($ip);
                    $ip = preg_replace('/\s+/', " ", $ip);
                    
                    return $ip;
                } else {
                    throw new Exception('IP, Não pode conter Tags de Programação');
                }
            } else {
                throw new Exception('IP não presente');
            }
        }
        
        public static function validar_nome($nome = null) : string
        {
            if (!empty($nome)) {
                $valor = strip_tags($nome);
                
                if ($valor === $nome) {
                    $nome = trim($nome);
                    $nome = preg_replace('/\s+/', " ", $nome);
                    
                    if (strlen($nome) <= 150) {
                        return ucwords(strtolower($nome));
                    } else {
                        throw new Exception('Nome do dono do cartão, Não pode conter mais de 100 Caracteres');
                    }
                } else {
                    throw new Exception('Nome do dono do cartão, Não pode conter Tags de Programação');
                }
            } else {
                throw new Exception('Nome do dono do cartão não presente');
            }
        }
        
        public static function validar_cpf($cpf = null) : string
        {
            if (!empty($cpf)) {
                $valor = strip_tags($cpf);
                
                if ($valor === $cpf) {
                    $cpf = trim($cpf);
                    $cpf = preg_replace('/\s+/', " ", $cpf);
                    $cpf = preg_replace('/[^a-zA-Z0-9]/', "", $cpf);
                    
                    if (strlen($cpf) === 11) {
                        $class_cpf_cnpj = new CPF_CNPJ($cpf);
                        
                        if ($class_cpf_cnpj->valida()) {
                            return $cpf;
                        } else {
                            throw new Exception('CPF inválido');
                        }
                    } else {
                        throw new Exception('CPF, deve conter exatos 11 caracteres');
                    }
                } else {
                    throw new Exception('CPF, Não pode conter Tags de Programação');
                }
            } else {
                throw new Exception('CPF não presente');
            }
        }
        
        public static function validar_cpf_cnpj($cpf_cnpj = null) : string
        {
            if (empty($cpf_cnpj)) {
                throw new Exception('Informe o CPF ou CNPJ do dono do cartão');
            } else {
                $cpf_cnpj = trim($cpf_cnpj);
                $cpf_cnpj = preg_replace('/\s+/', " ", $cpf_cnpj);
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
                    throw new Exception('CPF/CNPJ, Digite Apenas Números');
                }
            }
        }
        
        public static function validar_nascimento($nascimento = null) : string
        {
            if (!empty($nascimento)) {
                $valor = strip_tags($nascimento);
                
                if ($valor === $nascimento) {
                    $nascimento = trim($nascimento);
                    $nascimento = preg_replace('/\s+/', " ", $nascimento);
                    
                    if (strlen($nascimento) === 10) {
                        return $nascimento;
                    } else {
                        throw new Exception('Data de Nascimento do dono do cartão, preenchimento incompleto');
                    }
                } else {
                    throw new Exception('Data de Nascimento do dono do cartão, Não pode conter Tags de Programação');
                }
            } else {
                throw new Exception('Data de Nascimento do dono do cartão não presente');
            }
        }
        
        public static function validar_id($id = null) : void
        {
            
        }
        
        public static function validar_entidade_id($entidade_id = null) : void
        {
            
        }
        
        public static function validar_valor_total($valor_total = null) : void
        {
            
        }
        
        public static function validar_status_id($status_id = null) : void
        {
            
        }
        
        public static function validar_data_emissao($data_emissao = null) : void
        {
            
        }
        
        public static function validar_data_vencimento($data_vencimento = null) : void
        {
            
        }
        
        public static function validar_data_fechamento($data_vencimento = null) : void
        {
            
        }
        
        public static function filtrar_id($id = null) : void
        {
            
        }
        
        public static function filtrar_entidade_id($entidade_id = null) : void
        {
            
        }
        
        public static function filtrar_valor_total($valor_total = null) : void
        {
            
        }
        
        public static function filtrar_status_id($status_id = null) : void
        {
            
        }
        
        public static function filtrar_data_emissao($data_emissao = null) : void
        {
            
        }
        
        public static function filtrar_data_vencimento($data_vencimento = null) : void
        {
            
        }
        
        public static function filtrar_data_fechamento($data_vencimento = null) : void
        {
            
        }
    }
