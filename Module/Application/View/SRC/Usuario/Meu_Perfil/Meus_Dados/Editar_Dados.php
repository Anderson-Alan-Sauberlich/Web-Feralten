<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados;
    
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Menu_Usuario;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco as View_Endereco;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade as View_Entidade;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Usuario as View_Usuario;
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Editar_Dados
    {
        function __construct($status)
        {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $view_usuario;
        private static $view_entidade;
        private static $view_endereco;
        
        public function set_view_usuario(View_Usuario $view_usuario) : void
        {
            self::$view_usuario = $view_usuario;
        }
        
        public function set_view_entidade(View_Entidade $view_entidade) : void
        {
            self::$view_entidade = $view_entidade;
        }
        
        public function set_view_endereco(View_Endereco $view_endereco) : void
        {
            self::$view_endereco = $view_endereco;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Meus_Dados/Editar_Dados.php';
        }
        
        public static function Incluir_Menu_Usuario()
        {
            new View_Menu_Usuario(self::$status_usuario, ['meus-dados', 'editar-dados']);
        }
        
        public static function Incluir_View_Usuario() : void
        {
            if (self::$view_usuario instanceof View_Usuario) {
                self::$view_usuario->Executar();
            }
        }
        
        public static function Incluir_View_Entidade() : void
        {
            if (self::$view_entidade instanceof View_Entidade) {
                self::$view_entidade->Executar();
            }
        }
        
        public static function Incluir_View_Endereco() : void
        {
            if (self::$view_endereco instanceof View_Endereco) {
                self::$view_endereco->Executar();
            }
        }
        
        public static function VerificaLoginEntidade() : bool
        {
            return Login_Session::Verificar_Entidade();
        }
    }
