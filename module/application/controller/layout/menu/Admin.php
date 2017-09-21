<?php
namespace module\application\controller\layout\menu;
    
    use module\application\model\dao\Usuario_Admin as DAO_Usuario_Admin;
    use module\application\model\object\Usuario_Admin as Object_Usuario_Admin;
    
    class Admin {

        function __construct() {
            
        }
        
        public static function Verificar_Autenticacao() : bool {
            if (empty($_SESSION['usuario_admin'])) {
                $login_admin_erros = array();
                $login_admin_erros[] = "Você deve estar Autenticado.";
                $_SESSION['login_admin_erros'] = $login_admin_erros;
                
                return false;
            } else {
            	return true;
            }
        }
    }
?>