<?php
namespace Module\Application\Model\Validador;
    
    use \Exception;
    
    class Orcamento
    {
        
        function __constructor()
        {
            
        }
        
        public static function validar_id($id = null) : int
        {
            if (empty($id)) {
                throw new Exception("Informe um ID para o Orçamento");
            } else {
                if (filter_var($id, FILTER_VALIDATE_INT)) {
                    return $id;
                } else {
                    throw new Exception("Informe um ID Válido Para o Orçamento");
                }
            }
        }
        
        public static function validar_categoria_id($id = null) : int
        {
            return Categoria::validar_id($id);
        }
        
        public static function validar_marca_id($id = null) : int
        {
            return Marca::validar_id($id);
        }
        
        public static function validar_modelo_id($id = null) : int
        {
            return Modelo::validar_id($id);
        }
        
        public static function validar_versao_id($id = null) : int
        {
            return Versao::validar_id($id);
        }
        
        public static function validar_ano($ano = null) : void
        {
            
        }
        
        public static function validar_ano_de($ano_de = null) : ?int
        {
            return Categoria_Pativel::validar_ano_de($ano_de);
        }
        
        public static function validar_ano_ate($ano_ate = null) : ?int
        {
            return Categoria_Pativel::validar_ano_ate($ano_ate);
        }
        
        public static function validar_anos($anos = null) : void
        {
            
        }
        
        public static function validar_peca_nome($nome = null) : string
        {
            return Peca::validar_nome($nome);
        }
        
        public static function validar_serie($serie = null) : ?string
        {
            return Peca::validar_serie($serie);
        }
        
        public static function validar_estado_uso($estado_uso = null) : ?int
        {
            return Peca::validar_estado_uso($estado_uso);
        }
        
        public static function validar_preferencia_entrega($preferencia_entrega = null) : ?int
        {
            return Peca::validar_preferencia_entrega($preferencia_entrega);
        }
        
        public static function validar_descricao($descricao = null) : ?string
        {
            return Peca::validar_descricao($descricao);
        }
        
        public static function validar_data_solicitacao($data_solicitacao)
        {
            if (!empty($data_solicitacao)) {
                $valor = strip_tags($data_solicitacao);
                
                if ($valor === $data_solicitacao) {
                    $data_solicitacao = trim($data_solicitacao);
                    
                    return strtolower($data_solicitacao);
                } else {
                    throw new Exception('Data da solicitação, não pode conter tags de programação');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_data_validade($data_validade)
        {
            if (!empty($data_validade)) {
                $valor = strip_tags($data_validade);
                
                if ($valor === $data_validade) {
                    $data_validade = trim($data_validade);
                    
                    return strtolower($data_validade);
                } else {
                    throw new Exception('Data da validade, não pode conter tags de programação');
                }
            } else {
                return null;
            }
        }
        
        public static function filtrar_id($id = null) : int
        {
            $valor = 0;
            
            if (!empty($id) AND filter_var($id, FILTER_VALIDATE_INT)) {
                $valor = $id;
            }
            
            return $valor;
        }
        
        public static function filtrar_categoria_id($id = null) : int
        {
            return Categoria::filtrar_id($id);
        }
        
        public static function filtrar_marca_id($id = null) : int
        {
            return Marca::filtrar_id($id);
        }
        
        public static function filtrar_modelo_id($id = null) : int
        {
            return Modelo::filtrar_id($id);
        }
        
        public static function filtrar_versao_id($id = null) : int
        {
            return Versao::filtrar_id($id);
        }
        
        public static function filtrar_ano($ano = null) : void
        {
            
        }
        
        public static function filtrar_ano_de($ano_de = null) : ?int
        {
            return Categoria_Pativel::filtrar_ano_de($ano_de);
        }
        
        public static function filtrar_ano_ate($ano_ate = null) : ?int
        {
            return Categoria_Pativel::filtrar_ano_ate($ano_ate);
        }
        
        public static function filtrar_anos($anos = null) : void
        {
            
        }
        
        public static function filtrar_nome($nome = null) : string
        {
            return Peca::filtrar_nome($nome);
        }
        
        public static function filtrar_serie($serie = null) : ?string
        {
            return Peca::filtrar_serie($serie);
        }
        
        public static function filtrar_estado_uso($estado_uso = null) : ?int
        {
            return Peca::filtrar_estado_uso($estado_uso);
        }
        
        public static function filtrar_preferencia_entrega($preferencia_entrega = null) : ?int
        {
            return Peca::filtrar_preferencia_entrega($preferencia_entrega);
        }
        
        public static function filtrar_descricao($descricao = null) : ?string
        {
            return Peca::filtrar_descricao($descricao);
        }
        
        public static function filtrar_data_solicitacao($data_solicitacao = null) : ?string
        {
            $valor = null;
            
            if (!empty($data_solicitacao)) {
                $valor = preg_replace('/\s+/', " ", trim(strip_tags($data_solicitacao)));
            }
            
            return $valor;
        }
        
        public static function filtrar_data_validade($data_validade = null) : ?string
        {
            $valor = null;
            
            if (!empty($data_validade)) {
                $valor = preg_replace('/\s+/', " ", trim(strip_tags($data_validade)));
            }
            
            return $valor;
        }
    }
