<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
    
    require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
    require_once(RAIZ.'/application/model/object/usuario.php');
    require_once(RAIZ.'/application/model/object/dados_usuario.php');
    require_once(RAIZ.'/application/model/object/contato.php');
    
    use application\controller\usuario\meu_perfil\meus_dados\Atualizar as Controller_Atualizar;
    use application\model\object\Usuario as Object_Usuario;
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\object\Contato as Object_Contato;
    
    @session_start();
    
    class Atualizar {
    
        function __construct() {        	
            require_once(RAIZ.'/application/view/html/usuario/meu_perfil/meus_dados/atualizar.php');
        }
        
        public static function Manter_Valor($quadro, $campo) {
            if (isset($_SESSION['form_atualizar'])) {
                $form_atualizar = $_SESSION['form_atualizar'];
                
                if (isset($form_atualizar[$campo])) {
                    echo $form_atualizar[$campo];
                    unset($form_atualizar[$campo]);
					if (count($form_atualizar) > 0) {
                    	$_SESSION['form_atualizar'] = $form_atualizar;
					} else {
						unset($_SESSION['form_atualizar']);
					}
                } else {
                    self::Pegar_Valor($quadro, $campo);
                }
            } else {
                self::Pegar_Valor($quadro, $campo);
            }
        }
		
		public static function Manter_Imagem() {
			if (isset($_SESSION['imagem_tmp'])) {
				if ($_SESSION['imagem_tmp'] == "del") {
					echo "/application/view/resources/img/imagem_Indisponivel.png";
				} else {
					echo Controller_Atualizar::Pegar_Imagem_URL($_SESSION['imagem_tmp']);
				}
			} else {
				$imagem = Controller_Atualizar::Pegar_DadosUsuario_Imagem();
				
				if (isset($imagem)) {
					echo str_replace("@", "200x150", $imagem);
				} else {
					echo "/application/view/resources/img/imagem_Indisponivel.png";
				}
			}
		}
        
        public static function Mostrar_Erros($form) {
            if (isset($_SESSION['erros_usuario']) and $form == "atualizar_login") {
                $erros_usuario = $_SESSION['erros_usuario'];
                if (isset($erros_usuario)) {
                    echo "<div class=\"container-fluid\"><div class=\"row\">";
                    foreach ($erros_usuario as $value) {
                        echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                    }
                    echo "</div></div>";
                }
                unset($_SESSION['erros_usuario']);
            } else if (isset($_SESSION['erros_dadosusuario']) and $form == "atualizar_dadosusuario") {
                $erros_dadosusuario = $_SESSION['erros_dadosusuario'];
                if (isset($erros_dadosusuario)) {
                    echo "<div class=\"container-fluid\"><div class=\"row\">";
                    foreach ($erros_dadosusuario as $value) {
                        echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                    }
                    echo "</div></div>";
                }
                unset($_SESSION['erros_dadosusuario']);
            } else if (isset($_SESSION['erros_contato']) and $form == "atualizar_contato") {
                $erros_contato = $_SESSION['erros_contato'];
                if (isset($erros_contato)) {
                    echo "<div class=\"container-fluid\"><div class=\"row\">";
                    foreach ($erros_contato as $value) {
                        echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                    }
                    echo "</div></div>";
                }
                unset($_SESSION['erros_contato']);
            }
        }
        
        public static function Mostrar_Sucesso($form) {
            if (isset($_SESSION['success_usuario']) and $form == "atualizar_login") {
                $success_usuario = $_SESSION['success_usuario'];
				if (isset($success_usuario)) {
					echo "<div class=\"container-fluid\"><div class=\"row\">";
                	foreach ($success_usuario as $value) {
                		echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong><span class=\"glyphicon glyphicon-ok\"></span></strong> " . $value . "</div>";
					}
					echo "</div></div>";
				}
                unset($_SESSION['success_usuario']);
            } else if (isset($_SESSION['success_dadosusuario']) and $form == "atualizar_dadosusuario") {
                $success_dadosusuario = $_SESSION['success_dadosusuario'];
                if (isset($success_dadosusuario)) {
                    echo "<div class=\"container-fluid\"><div class=\"row\">";
                    foreach ($success_dadosusuario as $value) {
                        echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong><span class=\"glyphicon glyphicon-ok\"></span></strong> " . $value . "</div>";
                    }
                    echo "</div></div>";
                }
                unset($_SESSION['success_dadosusuario']);
            } else if (isset($_SESSION['success_contato']) and $form == "atualizar_contato") {
                $success_contato = $_SESSION['success_contato'];
				if (isset($success_contato)) {
					echo "<div class=\"container-fluid\"><div class=\"row\">";
                	foreach ($success_contato as $value) {
                		echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong><span class=\"glyphicon glyphicon-ok\"></span></strong> " . $value . "</div>";
					}
					echo "</div></div>";
				}
                unset($_SESSION['success_contato']);
            }
        }
        
        public static function Incluir_Classe_Erros($quadro, $campo) {
            switch ($quadro) {
                
                case "login":
                    self::Incluir_Classe_Erros_Usuario($campo);
                    break;
                    
                case "dadosusuario":
                    self::Incluir_Classe_Erros_DadosUsuario($campo);
                    break;
                    
                case "contato":
                    self::Incluir_Classe_Erros_Contato($campo);
                    break;
            }            
        }
        
        private function Incluir_Classe_Erros_Usuario($campo) {
        	if (isset($_SESSION['alt_campos'])) {
	            $alt_campos = $_SESSION['alt_campos'];
	            
	            switch ($campo) {
	                
	                case "nome":
	                	if (isset($alt_campos['erro_nome'])) {
		                    if ($alt_campos['erro_nome'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_nome'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_nome']);
	                	}
	                	
	                    break;
	                    
	                case "email":
	                	if (isset($alt_campos['erro_email'])) {
		                    if ($alt_campos['erro_email'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_email'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_email']);
	                	}
	                    
	                    break;
						
	                case "confemail":
	                	if (isset($alt_campos['erro_confemail'])) {
		                    if ($alt_campos['erro_confemail'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_confemail'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_confemail']);
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
        
        private function Incluir_Classe_Erros_DadosUsuario($campo) {
        	if (isset($_SESSION['alt_campos'])) {
	            $alt_campos = $_SESSION['alt_campos'];
	            
	            switch ($campo) {
	                
	                case "nomedadosusuario":
	                	if (isset($alt_campos['erro_nomedadosusuario'])) {
		                    if ($alt_campos['erro_nomedadosusuario'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_nomedadosusuario'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_nomedadosusuario']);
	                	}
	                    
	                    break;
	                    
	                case "cpf_cnpj":
	                	if (isset($alt_campos['erro_cpf_cnpj'])) {
		                    if ($alt_campos['erro_cpf_cnpj'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_cpf_cnpj'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_cpf_cnpj']);
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
        
        private function Incluir_Classe_Erros_Contato($campo) {
        	if (isset($_SESSION['alt_campos'])) {
	            $alt_campos = $_SESSION['alt_campos'];
	            
	            switch ($campo) {
	                
	                case "fone1":
	                	if (isset($alt_campos['erro_fone1'])) {
		                    if ($alt_campos['erro_fone1'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_fone1'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_fone1']);
	                	}
	                	
	                    break;
	                    
	                case "fone2":
	                	if (isset($alt_campos['erro_fone2'])) {
		                    if ($alt_campos['erro_fone2'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_fone2'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_fone2']);
	                	}
	                	
	                    break;
	                    
	                case "emailcontato":
	                	if (isset($alt_campos['erro_emailcontato'])) {
		                    if ($alt_campos['erro_emailcontato'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($alt_campos['erro_emailcontato'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($alt_campos['erro_emailcontato']);
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
        
        private static function Pegar_Valor($quadro, $campo) {
        	switch ($quadro) {
        		case "login":
        			if ($campo == "nome") {
        				echo Controller_Atualizar::Pegar_Usuario_Nome();
        			} else if ($campo == "email") {
        				echo Controller_Atualizar::Pegar_Usuario_Email();
        			} else if ($campo == "confemail") {
        				echo Controller_Atualizar::Pegar_Usuario_Email();
        			}
        			break;
        
        		case "dadosusuario":
        			if ($campo == "nomedadosusuario") {
        				echo Controller_Atualizar::Pegar_DadosUsuario_Nome();
        			} else if ($campo == "cpf_cnpj") {
        				echo Controller_Atualizar::Pegar_DadosUsuario_CPF_CNPJ();
        			} else if ($campo == "site") {
        				echo Controller_Atualizar::Pegar_DadosUsuario_Site();
        			}
        			break;
        
        		case "contato":
        			if ($campo == "fone1") {
        				echo Controller_Atualizar::Pegar_Contato_Fone1();
        			} else if ($campo == "fone2") {
        				echo Controller_Atualizar::Pegar_Contato_Fone2();
        			} else if ($campo == "emailcontato") {
        				echo Controller_Atualizar::Pegar_Contato_Email();
        			}
        			break;
        	}
        }
    }
?>