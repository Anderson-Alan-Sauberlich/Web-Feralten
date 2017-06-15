<?php
namespace application\view\src\include_page\menu;
    
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';

	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	
    class Usuario {
    	
    	private static $status_usuario;
    	private static $url_menu;

        function __construct(int $status, array $url) {
        	self::$status_usuario = $status;
        	self::$url_menu = $url;
        	
        	require_once RAIZ.'/application/view/html/include_page/menu/usuario.php';
        }
        
        public static function Mostrar_Nome() : void {
            echo Controller_Usuario::Mostrar_Nome();
        }
        
        public static function Incluir_Mensagem_Status_Usuario() : void {
        	if (self::$status_usuario !== null) {
	        	if (self::$status_usuario === 0 
	        		AND self::$url_menu[1] !== 'concluir'
	        		AND self::$url_menu[1] !== 'alterar-senha') {
	        		include_once RAIZ.'/application/view/html/include_page/mensagens/cadastro_incompleto.php';
	        	} else if (self::$status_usuario === 1) {
	        
	        	} else if (self::$status_usuario === 2) {
	        		include_once RAIZ.'/application/view/html/include_page/mensagens/pagamento_atrasado.php';
	        	} else if (self::$status_usuario === 3) {
	        		include_once RAIZ.'/application/view/html/include_page/mensagens/conta_desativada.php';
	        	}
        	}
        }
        
        public static function Verificar_URL_Ativa(string $id_tab, ?string $id_pill = null) : void {
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