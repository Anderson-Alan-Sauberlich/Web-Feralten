<?php
namespace Module\Application\View\SRC\Layout\Menu;
    
    class Usuario
    {
        private static $status_usuario;
        private static $url_menu;
        
        function __construct(int $status, array $url)
        {
            self::$status_usuario = $status;
            self::$url_menu = $url;
            
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Menu/Usuario.php';
        }
        
        public static function Verificar_URL_Ativa(string $id_tab, ?string $id_pill = null) : void
        {
            $class = '';
            
            if (self::$url_menu[0] === $id_tab) {
                $class = 'active';
                
                if (!empty($id_pill)) {
                    if (self::$url_menu[1] !== $id_pill) {
                        $class = '';
                    }
                }
            }
            
            echo $class;
        }
    }
