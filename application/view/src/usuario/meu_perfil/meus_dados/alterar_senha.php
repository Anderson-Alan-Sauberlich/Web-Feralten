<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
    
    require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php');
    require_once(RAIZ.'/application/model/object/usuario.php');
    
    use application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha as Controller_Alterar_Senha;
    use application\model\object\Usuario as Object_Usuario;
    
    @session_start();
    
    class Alterar_Senha {
    
        function __construct() {
            ob_start();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            	if (isset($_POST['salvar'])) {
					$this->Atualizar_E_Alterar_Senha();
				}
            }
        }
        
        private function Atualizar_E_Alterar_Senha() {
			$senha_antiga_usuario = $_POST["senha_antiga"];
            $senha_nova_usuario = $_POST["confsenha_nova"] == $_POST['senha_nova'] ? $_POST['senha_nova'] : "erro";
            
			if ($_POST['confsenha_nova'] == $_POST['senha_nova']) {
				$senha_nova_usuario = $_POST['senha_nova'];
			} else if (isset($_POST['confsenha_nova']) AND empty($_POST['senha_nova'])) {
				$senha_nova_usuario = "erro1";
			} else if (isset($_POST['senha_nova']) AND empty($_POST['confsenha_nova'])) {
				$senha_nova_usuario = "erro2";
			} else {
				$senha_nova_usuario = "erro";
			}
			
            Controller_Alterar_Senha::Atualizar_Senha_Usuario($senha_antiga_usuario, $senha_nova_usuario);
            
			if (isset($_SESSION['erros_alterar_senha'])) {
				$this->Salvar_Post();
				header("location: /usuario/meu-perfil/meus-dados/alterar-senha/");
			} else {
				header("location: /usuario/meu-perfil/");
			}
        }
        
		private static function Salvar_Post() {
			$form_alterar_senha = array();
			
			$form_alterar_senha['senha_antiga'] = $_POST['senha_antiga'];
			$form_alterar_senha['senha_nova'] = $_POST['senha_nova'];
			$form_alterar_senha['confsenha_nova'] = $_POST['confsenha_nova'];
			
			$_SESSION['form_alterar_senha'] = $form_alterar_senha;
		}
		
        public static function Manter_Valor($campo) {
            if (isset($_SESSION['form_alterar_senha'])) {
                $form_alterar_senha = $_SESSION['form_alterar_senha'];
                
                if (isset($form_alterar_senha[$campo])) {
                    echo $form_alterar_senha[$campo];
                    unset($form_alterar_senha[$campo]);
					if (count($form_alterar_senha) > 0) {
                    	$_SESSION['form_alterar_senha'] = $form_alterar_senha;
					} else {
						unset($_SESSION['form_alterar_senha']);
					}
                }
            }
        }
        
        public static function Mostrar_Erros() {
            if (isset($_SESSION['erros_alterar_senha'])) {
                $erros_alterar_senha = $_SESSION['erros_alterar_senha'];
                if (isset($erros_alterar_senha)) {
                    echo "<div class=\"container-fluid\"><div class=\"row\">";
                    foreach ($erros_alterar_senha as $value) {
                        echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                    }
                    echo "</div></div>";
                }
                unset($_SESSION['erros_alterar_senha']);
            }
        }
        
        public function Incluir_Classe_Erros($campo) {
        	if (isset($_SESSION['alt_campos'])) {
	            $alt_campos = $_SESSION['alt_campos'];
	            
	            switch ($campo) {
	                case "senha_antiga":
	                	if (isset($alt_campos['erro_senha_antiga'])) {
		                    if ($alt_campos['erro_senha_antiga'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_senha_antiga'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_senha_antiga']);
	                	}
	                	
	                    break;
						
	                case "senha_nova":
	                	if (isset($alt_campos['erro_senha_nova'])) {
		                    if ($alt_campos['erro_senha_nova'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_senha_nova'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_senha_nova']);
	                	}
	                	
	                    break;
						
	                case "confsenha_nova":
	                	if (isset($alt_campos['erro_confsenha_nova'])) {
		                    if ($alt_campos['erro_confsenha_nova'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_confsenha_nova'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_confsenha_nova']);
	                	}
	                	
	                    break;
	            }
	            
				if (count($alt_campos) > 0) {
	            	$_SESSION['alt_campos'] = $alt_campos;
            	} else {
            		unset($_SESSION['alt_campos']);
            	}
            }
        }
    }
?>