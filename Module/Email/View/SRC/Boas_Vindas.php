<?php
namespace Module\Email\View\SRC;
    
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    
    class Boas_Vindas
    {
        function __construct()
        {
            
        }
        
        private static $obj_usuario;
        
        public function set_obj_usuario(OBJ_Usuario $obj_usuario) : void
        {
            self::$obj_usuario = $obj_usuario;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Email/View/HTML/Boas_Vindas.php';
        }
        
        public static function Retornar_Nome_Usuario() : ?string
        {
            if (self::$obj_usuario instanceof OBJ_Usuario) {
                return self::$obj_usuario->get_nome();
            } else {
                return null;
            }
        }
    }
