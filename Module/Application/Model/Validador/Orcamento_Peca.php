<?php
namespace Module\Application\Model\Validador;
    
    use \Exception;
    
    class Orcamento_Peca
    {
        
        function __constructor()
        {
            
        }
        
        public static function validar_orcamento_id($id = null) : int
        {
            return Orcamento::validar_id($id);
        }
        
        public static function validar_peca_id($id = null) : int
        {
            return Peca::validar_id($id);
        }
        
        public static function filtrar_orcamento_id($id = null) : int
        {
            return Orcamento::filtrar_id($id);
        }
        
        public static function filtrar_peca_id($id = null) : int
        {
            return Peca::filtrar_id($id);
        }
    }
