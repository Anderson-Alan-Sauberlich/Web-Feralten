<?php
namespace module\application\view\src\usuario\meu_perfil;
    
    use module\application\view\src\layout\menu\Usuario as View_Usuario;
	
    class Perfil
    {

        function __construct(int $status)
        {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        
        public function Executar()
        {
        	require_once RAIZ.'/module/application/view/html/usuario/meu_perfil/Perfil.php';
        }
        
        public static function Incluir_Menu_Usuario()
        {
        	new View_Usuario(self::$status_usuario, array('meu-perfil', null));
        }
    }
