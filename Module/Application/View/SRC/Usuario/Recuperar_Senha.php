<?php
namespace Module\Application\View\SRC\Usuario;
    
    use Module\Application\Model\Object\Recuperar_Senha as Object_Recuperar_Senha;
    
    class Recuperar_Senha
    {

        function __construct()
        {
            
        }
        
        private static $object_recuperar_senha;
        
        public function set_object_recuperar_senha(Object_Recuperar_Senha $object_recuperar_senha) : void
        {
            self::$object_recuperar_senha = $object_recuperar_senha;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Recuperar_Senha.php';
        }
        
        public static function Verificar_Codigo_Setado() : bool
        {
            if (isset(self::$object_recuperar_senha)) {
                if (empty(self::$object_recuperar_senha->get_codigo())) {
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
            if (isset(self::$object_recuperar_senha)) {
                if (!empty(self::$object_recuperar_senha->get_codigo())) {
                    echo hash_hmac('sha512', self::$object_recuperar_senha->get_codigo(), hash('sha512', self::$object_recuperar_senha->get_codigo()));
                }
            }
        }
    }
