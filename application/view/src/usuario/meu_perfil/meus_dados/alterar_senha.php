<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
    
    require_once RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php';
    require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
    
    use application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha as Controller_Alterar_Senha;
    use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
    
    @session_start();
    
    class Alterar_Senha {
    	
    	private static $status_usuario;
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        	
            require_once RAIZ.'/application/view/html/usuario/meu_perfil/meus_dados/alterar_senha.php';
        }
		
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('meus-dados', 'alterar-senha'));
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