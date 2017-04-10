<?php
namespace application\controller\include_page\menu;
    
    require_once RAIZ.'/application/model/util/login_session.php';
    
    use application\model\util\Login_Session;
    
    class Usuario {

        function __construct() {
            
        }
        
        public static function Verificar_Autenticacao() : bool {
            if (empty($_SESSION['login'])) {
                $login_erros = array();
                $login_erros[] = "Você deve estar Autenticado.";
                $_SESSION['login_erros'] = $login_erros;
                
                return false;
            } else {
            	return true;
            }
        }
        
        public static function Verificar_Status_Usuario() {
        	$status = Login_Session::get_entidade_status();
        	
        	if ($status == null) {
        		return 0;
        	} else if ($status == 1) {
        		return 1;
        	} else if ($status == 2) {
        		return 2;
        	} else if ($status == 3) {
        		return 3;
        	} else {
        		return null;
        	}
        }
        
        public static function Mostrar_Nome() {
        	return Login_Session::get_usuario_nome();
        }
    }
?>