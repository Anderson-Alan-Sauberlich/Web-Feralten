<?php
namespace application\controller\include_page;
    
    require_once(RAIZ.'/application/model/object/class_dados_usuario.php');
    require_once(RAIZ.'/application/model/dao/dao_dados_usuario.php');
    require_once(RAIZ.'/application/model/object/class_usuario.php');
    
    use application\model\object\Dados_Usuario;
    use application\model\dao\DAO_Dados_Usuario;
    use application\model\object\Usuario;
    
    @session_start();
    
    class Menu_Usuario {

        function __construct() {
            
        }
        
        public static function Verificar_Autenticacao() {
        	
			
            if (empty($_SESSION['usuario'])) {
                $login_erros = array();
                $login_erros[] = "Você deve estar Autenticado.";
                $_SESSION['login_erros'] = $login_erros;
                header("location: /usuario/login/");
                ob_end_flush();
            }
        }
        
        public static function Pegar_Status_Usuario() {
            return DAO_Dados_Usuario::Pegar_Status_Usuario(unserialize($_SESSION['usuario'])->get_id());
        }
    }
?>