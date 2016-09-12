<?php
namespace application\view\src\usuario;

    require_once(RAIZ.'/application/controller/usuario/cadastro.php');
    require_once(RAIZ.'/application/model/object/class_usuario.php');

    use application\controller\usuario\Cadastro as Controller_Cadastro;
    use application\model\object\Usuario;

    @session_start();

    new Cadastro();

    class Cadastro {

        function __construct() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->Cadastrar();
            }
        }

        private function Salvar_Post() {
            $form_cadastro = array();
            
            $form_cadastro['nome'] = $_POST['nome'];
            $form_cadastro['email'] = $_POST['email'];
			$form_cadastro['confemail'] = $_POST['confemail'];
			$form_cadastro['senha'] = $_POST['password'];
            
            $_SESSION['form_cadastro'] = $form_cadastro;
        }

        private function Cadastrar() {
            $usuario = new Usuario();
            
            $usuario->set_id(0);
            $usuario->set_nome($_POST['nome']);
            $usuario->set_senha($_POST['password']);
			$usuario->set_ultimo_login(date("Y-m-d H:i:s"));
			
			if ($_POST['confemail'] == $_POST['email']) {
				$usuario->set_email($_POST['email']);
			} else if (isset($_POST['confemail']) AND empty($_POST['email'])) {
				$usuario->set_email("erro1");
			} else if (isset($_POST['email']) AND empty($_POST['confemail'])) {
				$usuario->set_email("erro2");
			} else {
				$usuario->set_email("erro");
			}
            
            Controller_Cadastro::Cadastrar_Usuario($usuario);
            
            if (isset($_SESSION['erros_cadastrar'])) {
            	$this->Salvar_Post();
                header("location: /usuario/cadastro/");
            } else {
                header("location: /usuario/meu-perfil/");
            }
        }
        
        public static function Mostrar_Erros() {
            if (isset($_SESSION['erros_cadastrar'])) {
                $erros_cadastrar = $_SESSION['erros_cadastrar'];
                if (isset($erros_cadastrar)) {
                    foreach ($erros_cadastrar as $value) {
                        echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                    }
                }
                unset($_SESSION['erros_cadastrar']);
            }
        }

        public static function Manter_Valor($campo) {
            if (isset($_SESSION['form_cadastro'])) {
                $form_cadastro = $_SESSION['form_cadastro'];
                
                if (isset($form_cadastro[$campo])) {
                    echo $form_cadastro[$campo];
                    unset($form_cadastro[$campo]);
					if (count($form_cadastro) > 0) {
                    	$_SESSION['form_cadastro'] = $form_cadastro;
                	} else {
                		unset($_SESSION['form_cadastro']);
                	}
				}
            }
        }
        
        public static function Incluir_Classe_Erros($campo) {
        	if (isset($_SESSION['cad_campos'])) {
	            $cad_campos = $_SESSION['cad_campos'];
	            
	            switch ($campo) {
	                case "nome":
	                	if (isset($cad_campos['erro_nome'])) {
		                    if ($cad_campos['erro_nome'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cad_campos['erro_nome'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cad_campos['erro_nome']);
	                	}
	                	
	                    break;
	                    
	                case "email":
	                	if (isset($cad_campos['erro_email'])) {
		                    if ($cad_campos['erro_email'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cad_campos['erro_email'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cad_campos['erro_email']);
	                	}
	                	
	                    break;
	                    
	                case "senha":
	                	if (isset($cad_campos['erro_senha'])) {
		                    if ($cad_campos['erro_senha'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cad_campos['erro_senha'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cad_campos['erro_senha']);
	                	}
	                	
	                    break;
	                    
	                case "confemail":
	                	if (isset($cad_campos['erro_confemail'])) {
		                    if ($cad_campos['erro_confemail'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cad_campos['erro_confemail'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cad_campos['erro_confemail']);
	                	}
	                	
	                    break;
	            }
	            
				if (count($cad_campos) > 0) {
	            	$_SESSION['cad_campos'] = $cad_campos;
				} else {
					unset($_SESSION['cad_campos']);
				}
	        }
        }
    }
?>