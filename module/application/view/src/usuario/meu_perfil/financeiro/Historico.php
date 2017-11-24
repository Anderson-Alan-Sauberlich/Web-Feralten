<?php
namespace module\application\view\src\usuario\meu_perfil\financeiro;
    
    use module\application\view\src\layout\menu\Usuario as View_Usuario;
    
    class Historico
    {
    	
        function __construct($status)
        {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar()
        {
        	require_once RAIZ.'/module/application/view/html/usuario/meu_perfil/financeiro/Historico.php';
        }
        
        public static function Incluir_Menu_Usuario()
        {
        	new View_Usuario(self::$status_usuario, array('financeiro', 'historico'));
        }
    }
