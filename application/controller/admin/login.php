<?php
namespace application\controller\admin;
	
	require_once RAIZ.'/application/view/src/admin/login.php';
	
	use application\view\src\admin\Login as View_Login;
	
    class Login {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Login();
        	
        	$view->Executar();
        }
    }
?>