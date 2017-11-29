<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Usuario;
    
    class Historico
    {
    	
        function __construct($status)
        {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar()
        {
        	require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Financeiro/Historico.php';
        }
        
        public static function Incluir_Menu_Usuario()
        {
        	new View_Usuario(self::$status_usuario, array('financeiro', 'historico'));
        }
    }
