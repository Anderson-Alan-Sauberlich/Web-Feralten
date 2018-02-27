<?php
namespace Module\Application\Model\Validador;
    
    use Module\Application\Model\DAO\Status_Peca as DAO_Status_Peca;
    use \Exception;
    
    class Status_Peca
    {
        function __constructor()
        {
            
        }
        
        public static function validar_id($id = null) : ?int
        {
            if (!empty($id)) {
                if (filter_var($id, FILTER_VALIDATE_INT)) {
                    return $id;
                } else {
                    throw new Exception('Selecione um Status para Peça Válido.');
                }
            } else {
                return null;
            }
        }
        
        public static function validar_nome($nome = null) : void
        {
            
        }
        
        public static function validar_url($url = null) : ?string
        {
            if (!empty($url)) {
                $valor = strip_tags($url);
                
                if ($valor === $url) {
                    $url = trim($url);
                    
                    return strtolower($url);
                } else {
                    throw new Exception('URL do Status da Peça, Não pode conter Tags de Programação');
                }
            } else {
                throw new Exception('URL do Status da Peça, Não Informada');
            }
        }
        
        public static function validar_status_url($status_url = null) : ?int
        {
            if (!empty($status_url)) {
                $valor = strip_tags($status_url);
                
                if ($valor === $status_url) {
                    $status_url = trim($status_url);
                    $status_url = preg_replace('/\s+/', " ", $status_url);
                    
                    $status_id = DAO_Status_Peca::Buscar_Id_Por_Url($status_url);
                    
                    if (!empty($status_id) AND $status_id !== false) {
                        return $status_id;
                    } else {
                        throw new Exception('Erro ao Procurar por Status');
                    }
                } else {
                    throw new Exception('Selecione um Status Valido.');
                }
            } else {
                return null;
            }
        }
        
        public static function filtrar_id($id = null) : void
        {
            
        }
        
        public static function filtrar_nome($nome = null) : void
        {
            
        }
        
        public static function filtrar_url($url = null) : void
        {
            
        }
    }
