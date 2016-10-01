<?php
namespace application\view\src\usuario;

    require_once RAIZ.'/application/controller/usuario/cadastro.php';
    require_once RAIZ.'/application/model/object/usuario.php';

    use application\controller\usuario\Cadastro as Controller_Cadastro;
    use application\model\object\Usuario as Object_Usuario;

    @session_start();

    class Cadastro {

        function __construct() {
        	require_once RAIZ.'/application/view/html/usuario/cadastro.php';
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