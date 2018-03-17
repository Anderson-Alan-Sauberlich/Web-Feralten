<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Layout\Header\Usuario as View_Header_Usuario;
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Menu_Usuario;
    
    class Meu_Plano
    {
        function __construct($status, $planos, $plano_id)
        {
            self::$planos = $planos;
            self::$status_usuario = $status;
            self::$plano_id = $plano_id;
        }
        
        private static $status_usuario;
        private static $planos;
        private static $plano_id;
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Financeiro/Meu_Plano.php';
        }
        
        public static function Incluir_Header_Usuario()
        {
            new View_Header_Usuario(self::$status_usuario, ['financeiro', 'meu-plano']);
        }
        
        public static function Incluir_Menu_Usuario()
        {
            new View_Menu_Usuario(self::$status_usuario, ['financeiro', 'meu-plano']);
        }
        
        public static function Mostrar_Valor(int $id) : void
        {
            echo self::$planos[$id]->get_valor_mensal();
        }
        
        public static function Mostrar_Class_Plano_Ativo(int $id) : void
        {
            if (self::$plano_id == $id) {
                echo 'inverted green active';
            }
        }
        
        public static function Mostrar_Texto_Plano_Ativo(int $id) : void
        {
            if (self::$plano_id == $id) {
                echo 'Ativo';
            } else {
                echo 'Contratar';
            }
        }
    }
