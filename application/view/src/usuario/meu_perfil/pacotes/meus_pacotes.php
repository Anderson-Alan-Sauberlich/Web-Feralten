<?php
namespace application\view\src\usuario\meu_perfil\pacotes;
    
	require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
	
	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;

    @session_start();

    class Meus_Pacotes {
    	
    	private static $status_usuario;

        function __construct($status) {
        	self::$status_usuario = $status;
        	 
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/financeiro/boleto_atual.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('pacotes', 'meus-pacotes'));
        }
    }
?>