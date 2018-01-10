<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil;
    
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Usuario;
    
    class Meus_Orcamentos
    {

        function __construct(int $status)
        {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Meus_Orcamentos.php';
        }
        
        public static function Incluir_Menu_Usuario()
        {
            new View_Usuario(self::$status_usuario, array('meu-perfil', 'meus-orcamentos'));
        }
    }
