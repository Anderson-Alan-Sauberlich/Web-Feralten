<?php
namespace Module\Email\View\SRC;
    
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    
    class Boas_Vindas
    {
        function __construct()
        {
            
        }
        
        private static $obj_usuario;
        
        public function set_obj_usuario(Object_Usuario $obj_usuario) : void
        {
            self::$obj_usuario = $obj_usuario;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Email/View/HTML/Boas_Vindas.php';
        }
        
        public static function Retornar_Nome_Usuario() : ?string
        {
            if (self::$obj_usuario instanceof Object_Usuario) {
                return self::$obj_usuario->get_nome();
            } else {
                return null;
            }
        }
    }
