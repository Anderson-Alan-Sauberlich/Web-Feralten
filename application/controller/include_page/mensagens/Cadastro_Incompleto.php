<?php
namespace application\controller\include_page\mensagens;
	
	use application\model\common\util\Login_Session;
	
    class Cadastro_Incompleto {

        function __construct() {
            
        }
        
        public static function Mostrar_Nome() : string {
        	return Login_Session::get_usuario_nome();
        }
    }
?>