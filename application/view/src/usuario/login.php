<?php
namespace application\view\src\usuario;

    require_once(RAIZ.'/application/controller/usuario/login.php');
    require_once(RAIZ.'/application/model/object/usuario.php');

    use application\controller\usuario\Login as Controller_Login;
    use application\model\object\Usuario as Object_Usuario;

    @session_start();

    class Login {

        function __construct() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->Autenticar();
            }
        }
        
        public static function Carregar_Pagina_HTML() {
        	require_once(RAIZ.'/application/view/html/usuario/login.php');
        }
        
        private function Salvar_Post() {
            $form_login = array();
            
            $form_login['email'] = $_POST['email'];
            
            $_SESSION['form_login'] = $form_login;
        }

        private function Autenticar() {
        	$email = null;
        	$senha = null;
        	$manter_login = null;
        	
        	if (isset($_POST["email"])) {
        		$email = $_POST["email"];
        	}
            if (isset($_POST["password"])) {
            	$senha = $_POST["password"];
            }
            if (isset($_POST['manter_login'])) {
            	$manter_login = $_POST['manter_login'];
            }
            
            Controller_Login::Autenticar_Usuario_Login($email, $senha, $manter_login);
            
            if (isset($_SESSION['login_erros'])) {
            	$this->Salvar_Post();
                header("location: /usuario/login/");
            } else {
                header("location: /usuario/meu-perfil/");
            }
        }
        
        public static function Manter_Valor($campo) {
            if (isset($_SESSION['form_login'])) {
                $form_login = $_SESSION['form_login'];
                
                if (isset($form_login[$campo])) {
                    echo $form_login[$campo];
                    unset($form_login[$campo]);
					if (count($form_login) > 0) {
                    	$_SESSION['form_login'] = $form_login;
                	} else {
                		unset($_SESSION['form_login']);
                	}
				}
            }
        }
        
        public static function Mostrar_Erros() {
            if (isset($_SESSION['login_erros'])) {
                $login_erros = $_SESSION['login_erros'];
                if (isset($login_erros)) {
                    foreach ($login_erros as $value) {
                        echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                    }
                }
                unset($_SESSION['login_erros']);
            }
        }
        
        public static function Mostrar_Sucesso() {
            if (isset($_SESSION['login_success'])) {
                $login_success = $_SESSION['login_success'];
				if (isset($login_success)) {
                	foreach ($login_success as $value) {
                		echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong><span class=\"glyphicon glyphicon-ok\"></span></strong> " . $value . "</div>";
					}
				}
                unset($_SESSION['login_success']);
            }
        }

        public static function Incluir_Classe_Erros($campo) {
        	if (isset($_SESSION['login_campos'])) {
	            $login_campos = $_SESSION['login_campos'];
	            switch ($campo) {
	                case "email":
	                	if (isset($login_campos['erro_email'])) {
		                    if ($login_campos['erro_email'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($login_campos['erro_email'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($login_campos['erro_email']);
	                	}
	                	
	                    break;
	                case "senha":
	                	if (isset($login_campos['erro_senha'])) {
		                    if ($login_campos['erro_senha'] == "erro") {
		                        echo "has-error has-feedback";
		                    }
		                    unset($login_campos['erro_senha']);
	                	}
	                	
	                    break;
	           }
	            
	            if (count($login_campos) > 0) {
	            	$_SESSION['login_campos'] = $login_campos;
	        	} else {
	        		unset($_SESSION['login_campos']);
	        	}
			}
		}
    }
?>