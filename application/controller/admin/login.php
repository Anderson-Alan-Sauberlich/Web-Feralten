<?php
namespace application\controller\admin;
	
	require_once RAIZ.'/application/model/common/util/filtro.php';
	require_once RAIZ.'/application/model/dao/usuario_admin.php';
	require_once RAIZ.'/application/view/src/admin/login.php';
	
	use application\model\common\util\Filtro;
	use application\model\dao\Usuario_Admin as DAO_Usuario_Admin;
	use application\view\src\admin\Login as View_Login;
	use \Exception;
	
    class Login {

        function __construct() {
            
        }
        
        private $usuario;
        private $senha;
        private $logout;
        private $login_admin_erros = array();
        
        public function set_usuario($usuario) {
        	try {
        		$this->usuario = Filtro::Usuario_Admin()::validar_usuario($usuario);
        	} catch (Exception $e) {
        		$this->login_admin_erros[] = $e->getMessage();
        		
        		$this->usuario = Filtro::Usuario_Admin()::filtrar_usuario($usuario);
        	}
        }
        
        public function set_senha($senha) {
        	try {
        		$this->senha = Filtro::Usuario_Admin()::validar_senha($senha);
	        } catch (Exception $e) {
	        	$this->login_admin_erros[] = $e->getMessage();
	        	
	        	$this->senha = Filtro::Usuario_Admin()::filtrar_senha($senha);
	        }
        }
        
        public function set_logout($logout) {
        	try {
        		$this->logout = Filtro::Usuario_Admin()::validar_logout($logout);
	        } catch (Exception $e) {
	        	$this->login_admin_erros[] = $e->getMessage();
	        	
	        	$this->logout = Filtro::Usuario_Admin()::filtrar_logout($logout);
	        }
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Login();
        	
        	$view->set_login_admin_erros($this->login_admin_erros);
        	
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
        	if (empty($this->login_admin_erros)) {
        		$usuario_login = DAO_Usuario_Admin::Autenticar($this->usuario);
        
        		if ($usuario_login !== false) {
        			if (password_verify($this->senha, $usuario_login->get_senha())) {
        				$_SESSION['usuario_admin'] = $usuario_login->get_id();
        			} else {
        				$this->login_admin_erros[] = "Erro ao tentar Autenticar";
        			}
        		} else {
        			$this->login_admin_erros[] = "Erro ao tentar Autenticar";
        		}
        	}
        
        	if (empty($this->login_admin_erros)) {
        		return true;
        	} else {
        		$this->Carregar_Pagina();
        	}
        }
    }
?>