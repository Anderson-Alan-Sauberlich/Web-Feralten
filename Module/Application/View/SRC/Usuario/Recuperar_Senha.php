<?php
namespace Module\Application\View\SRC\Usuario;
    
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
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Recuperar_Senha.php';
        }
        
        public static function Verificar_Codigo_Setado() : bool
        {
            if (isset(self::$obj_recuperar_senha)) {
                if (empty(self::$obj_recuperar_senha->get_codigo())) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
        
        public static function Mostrar_Codigo() : void
        {
            if (isset(self::$obj_recuperar_senha)) {
                if (!empty(self::$obj_recuperar_senha->get_codigo())) {
                    echo hash_hmac('sha512', self::$obj_recuperar_senha->get_codigo(), hash('sha512', self::$obj_recuperar_senha->get_codigo()));
                }
            }
        }
    }
