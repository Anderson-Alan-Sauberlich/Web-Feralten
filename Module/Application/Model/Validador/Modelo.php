<?php
namespace Module\Application\Model\Validador;
    
    use \Exception;
    
    class Modelo
    {
        function __constructor()
        {
            
        }
        
        public static function validar_id($id = null) : int
        {
            if (empty($id)) {
                throw new Exception("Selecione o modelo");
            } else {
                if (filter_var($id, FILTER_VALIDATE_INT)) {
                    return $id;
                } else {
                    throw new Exception("Selecione um modelo válido");
                }
            }
        }
        
        public static function validar_marca_id($marca_id = null) : void
        {
            
        }
        
        public static function validar_nome($nome = null) : void
        {
            
        }
        
        public static function validar_url($url_modelo = null) : string
        {
            if (empty($url_modelo)) {
                throw new Exception('URL do modelo não informado');
            } else {
                $url_modelo = trim($url_modelo);
                
                if (strip_tags($url_modelo) === $url_modelo) {
                    return $url_modelo;
                } else {
                    throw new Exception('URL do modelo inválida');
                }
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
        
        public static function filtrar_marca_id($marca_id = null) : void
        {
            
        }
        
        public static function filtrar_nome($nome = null) : void
        {
            
        }
        
        public static function filtrar_url($url_modelo = null) : string
        {
            $valor = '';
            
            if (!empty($url_modelo) AND filter_var($url_modelo, FILTER_VALIDATE_URL)) {
                $valor = $url_modelo;
            }
            
            return $valor;
        }
    }
