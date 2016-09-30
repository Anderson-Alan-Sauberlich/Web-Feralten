<?php
namespace application\view\src\include_page;

    require_once(RAIZ.'/application/controller/include_page/menu_usuario.php');
    
    use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
    
    @session_start();

    class Menu_Usuario {
    	
    	private static $status_usuario;
    	private static $url_menu;

        function __construct($status, $url) {
        	self::$status_usuario = $status;
        	self::$url_menu = $url;
        	
        	require_once(RAIZ.'/application/view/html/include_page/menu_usuario.php');
        }
        
        public static function Mostrar_Nome() {
            echo unserialize($_SESSION['usuario'])->get_nome();
        }
        
        public static function Incluir_Status_Usuario() {
        	if (isset(self::$status_usuario)) {
	        	if (self::$status_usuario === 0 AND self::$url_menu[1] !== 'concluir') {
	        		include_once(RAIZ.'/application/view/html/include_page/mensagens/cadastro_incompleto.php');
	        	} else if (self::$status_usuario === 1) {
	        
	        	} else if (self::$status_usuario === 2) {
	        		include_once(RAIZ.'/application/view/html/include_page/mensagens/pagamento_atrasado.php');
	        	} else if (self::$status_usuario === 3) {
	        		include_once(RAIZ.'/application/view/html/include_page/mensagens/conta_desativada.php');
	        	}
        	}
        }
        
        public static function Verificar_URL_Ativa($id_tab, $id_pill = null) {
        	$class = '';
        	
        	if (self::$url_menu[0] === $id_tab) {
        		$class = 'active';
        		
        		if (isset($id_pill)) {
	        		if (self::$url_menu[1] !== $id_pill) {
	        			$class = '';
	        		}
        		}
        	}
        	
        	if ($id_pill === 'concluir' AND self::$status_usuario !== 0) {
        		$class = 'disabled';
        	}
        	
        	echo $class;
        }
    }
?>