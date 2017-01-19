<?php
namespace application\controller\include_page\menu;
    
    require_once RAIZ.'/application/model/dao/dados_usuario.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    
    use application\model\dao\Dados_Usuario as DAO_Dados_Usuario;
    use application\model\object\Usuario as Object_Usuario;
    
    class Usuario {

        function __construct() {
            
        }
        
        public static function Verificar_Autenticacao() {
            if (empty($_SESSION['usuario'])) {
                $login_erros = array();
                $login_erros[] = "Você deve estar Autenticado.";
                $_SESSION['login_erros'] = $login_erros;
                
                return false;
            } else {
            	return true;
            }
        }
        
        public static function Verificar_Status_Usuario() {
        	$status = DAO_Dados_Usuario::Pegar_Status_Usuario(unserialize($_SESSION['usuario'])->get_id());
        
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
    }
?>