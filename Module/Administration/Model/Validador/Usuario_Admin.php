<?php
namespace Module\Administration\Model\Validador;
    
    use \Exception;
    
    class Usuario_Admin
    {
        
        function __constructor()
        {
            
        }
        
        public static function validar_id($id = null) : void
        {
            
        }
        
        public static function validar_usuario($usuario = null) : string
        {
            if (empty($usuario)) {
                throw new Exception('Digite seu Usuario');
            } else {
                return trim(strip_tags($usuario));
            }
        }
        
        public static function validar_nome($nome = null) : void
        {
            
        }
        
        public static function validar_senha($senha = null) : string
        {
            if (empty($senha)) {
                throw new Exception('Digite sua Senha');
            } else {
                return trim(strip_tags($senha));
            }
        }
        
        public static function validar_logout($logout = null) : string
        {
            if (empty($logout)) {
                throw new Exception('Codigo de Logout não Informado');
            } else {
                return trim(strip_tags($logout));
            }
        }
        
        public static function filtrar_id($id = null) : void
        {
            
        }
        
        public static function filtrar_usuario($usuario = null) : string
        {
            $valor = '';
            
            if (!empty($usuario)) {
                $valor = trim(strip_tags($usuario));
            }
            
            return $valor;
        }
        
        public static function filtrar_nome($nome = null) : void
        {
            
        }
        
        public static function filtrar_senha($senha = null) : string
        {
            $valor = '';
            
            if (!empty($senha)) {
                $valor = trim(strip_tags($senha));
            }
            
            return $valor;
        }
        
        public static function filtrar_logout($logout = null) : string
        {
            $valor = '';
            
            if (!empty($logout)) {
                $valor = trim(strip_tags($logout));
            }
            
            return $valor;
        }
    }
