<?php
namespace application\controller\include_page\mensagens;
	
	require_once RAIZ.'/application/model/common/util/login_session.php';
	
	use application\model\common\util\Login_Session;
	
    class Cadastro_Inconpleto {

        function __construct() {
            
        }
        
        public static function Mostrar_Nome() : string {
        	return Login_Session::get_usuario_nome();
        }
    }
?>