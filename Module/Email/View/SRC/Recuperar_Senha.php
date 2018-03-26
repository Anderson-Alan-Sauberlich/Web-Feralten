<?php
namespace Module\Email\View\SRC;
    
    use Module\Application\Model\OBJ\Recuperar_Senha as OBJ_Recuperar_Senha;
    
    class Recuperar_Senha
    {
        function __construct()
        {
            
        }
        
        private static $obj_recuperar_senha;
        
        public function set_obj_recuperar_senha(OBJ_Recuperar_Senha $obj_recuperar_senha) : void
        {
            self::$obj_recuperar_senha = $obj_recuperar_senha;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Email/View/HTML/Recuperar_Senha.php';
        }
        
        public static function Retornar_Nome_Usuario() : ?string
        {
            if (self::$obj_recuperar_senha instanceof OBJ_Recuperar_Senha) {
                return self::$obj_recuperar_senha->get_obj_usuario()->get_nome();
            } else {
                return null;
            }
        }
        
        public static function Retornar_Codigo() : ?string
        {
            if (self::$obj_recuperar_senha instanceof OBJ_Recuperar_Senha) {
                return hash_hmac('sha512', self::$obj_recuperar_senha->get_codigo(), hash('sha512', self::$obj_recuperar_senha->get_codigo()));
            } else {
                return null;
            }
        }
    }
