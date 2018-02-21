<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados;
    
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Object\Usuario as OBJ_Usuario;
    
    class Usuario
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
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Meus_Dados/Editar_Dados/Usuario.php';
        }
        
        public static function VerificaLoginEntidade() : bool
        {
            return Login_Session::Verificar_Entidade();
        }
        
        public static function MostrarNome() : ?string
        {
            if (self::$obj_usuario instanceof OBJ_Usuario) {
                return self::$obj_usuario->get_nome();
            }
            
            return null;
        }
        
        public static function MostrarSobrenome() : ?string
        {
            if (self::$obj_usuario instanceof OBJ_Usuario) {
                return self::$obj_usuario->get_sobrenome();
            }
            
            return null;
        }
        
        public static function MostrarEmail() : ?string
        {
            if (self::$obj_usuario instanceof OBJ_Usuario) {
                return self::$obj_usuario->get_email();
            }
            
            return null;
        }
        
        public static function MostrarEmailAlternativo() : ?string
        {
            if (self::$obj_usuario instanceof OBJ_Usuario) {
                return self::$obj_usuario->get_email_alternativo();
            }
            
            return null;
        }
        
        public static function MostrarFone() : ?string
        {
            if (self::$obj_usuario instanceof OBJ_Usuario) {
                if (Login_session::Verificar_Entidade()) {
                    return self::$obj_usuario->get_fone();
                }
            }
            
            return null;
        }
        
        public static function MostrarFoneAlternativo() : ?string
        {
            if (self::$obj_usuario instanceof OBJ_Usuario) {
                return self::$obj_usuario->get_fone_alternativo();
            }
            
            return null;
        }
        
        public static function CriarListagem(array $itens) : array
        {
            $lista = [];
            
            foreach ($itens as $item) {
                $lista[] = "<li>$item</li>";
            }
            
            return $lista;
        }
    }
