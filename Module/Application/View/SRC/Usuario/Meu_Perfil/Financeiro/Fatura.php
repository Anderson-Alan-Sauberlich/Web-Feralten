<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Usuario;
    
    class Fatura
    {
        
        /**
         * @param number|NULL $status
         */
        function __construct($status)
        {
            self::$status_usuario = $status;
        }
        
        /**
         * @var number|NULL
         */
        private static $status_usuario;
        
        /**
         * Abre a pagina html
         * 
         * @param
         * @return void
         */
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Financeiro/Fatura.php';
        }
        
        /**
         * Inclui a view do Menu Usuario na pagina
         * 
         * @param
         * @return void
         */
        public static function Incluir_Menu_Usuario() : void
        {
            new View_Usuario(self::$status_usuario, array('financeiro', 'fatura'));
        }
    }
