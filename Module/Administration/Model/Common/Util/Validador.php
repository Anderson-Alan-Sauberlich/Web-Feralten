<?php
namespace Module\Administration\Model\Common\Util;
    
    use Module\Administration\Model\Validador\Usuario_Admin;
    
    class Validador
    {
        
        function __construct()
        {
            
        }
        
        public static function Usuario_Admin() : Usuario_Admin { return new Usuario_Admin(); }
    }
