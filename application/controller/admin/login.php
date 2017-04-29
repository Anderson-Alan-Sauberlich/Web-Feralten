<?php
namespace application\controller\admin;
	
	require_once RAIZ.'/application/model/dao/usuario_admin.php';
	require_once RAIZ.'/application/view/src/admin/login.php';
	
	use application\model\dao\Usuario_Admin as DAO_Usuario_Admin;
	use application\view\src\admin\Login as View_Login;
	
    class Login {

        function __construct() {
            
        }
        
        private $usuario;
        private $senha;
        private $logout;
        
        public function set_usuario($usuario) {
        	$this->usuario = $usuario;
        }
        
        public function set_senha($senha) {
        	$this->senha = $senha;
        }
        
        public function set_logout($logout) {
        	$this->logout = $logout;
        }
        
        public function Carregar_Pagina(?array $login_admin_erros = null) {
        	$view = new View_Login();
        	
        	$view->set_login_admin_erros($login_admin_erros);
        	
        	$view->Executar();
        }
        
        public function LogOut() : void {
        	if (!empty($this->logout)) {
        		if(hash_equals($this->logout, hash_hmac('sha1', session_id(), sha1(session_id())))) {
        			unset($_SESSION['usuario_admin']);
        		}
        	}
        }
        
        public function Login() {
        	$login_admin_erros = array();
        
        	if (empty($this->usuario)) {
        		$login_admin_erros[] = "Digite seu Usuario";
        	}
        	
        	if (empty($this->senha)) {
        		$login_admin_erros[] = "Digite sua Senha";
        	}
        	
        	if (empty($login_admin_erros)) {
        		$usuario_login = DAO_Usuario_Admin::Autenticar($this->usuario);
        
        		if ($usuario_login !== false) {
        			if (password_verify($this->senha, $usuario_login->get_senha())) {
        				$_SESSION['usuario_admin'] = $usuario_login->get_id();
        			} else {
        				$login_admin_erros[] = "Erro ao tentar Autenticar";
        			}
        		} else {
        			$login_admin_erros[] = "Erro ao tentar Autenticar";
        		}
        	}
        
        	if (empty($login_admin_erros)) {
        		return true;
        	} else {
        		$this->Carregar_Pagina($login_admin_erros);
        	}
        }
    }
?>