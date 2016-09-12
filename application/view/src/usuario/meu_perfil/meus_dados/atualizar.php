<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
    
    require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
    require_once(RAIZ.'/application/model/object/class_usuario.php');
    require_once(RAIZ.'/application/model/object/class_dados_usuario.php');
    require_once(RAIZ.'/application/model/object/class_contato.php');
    
    use application\controller\usuario\meu_perfil\meus_dados\Atualizar as Controller_Atualizar;
    use application\model\object\Usuario;
    use application\model\object\Dados_Usuario;
    use application\model\object\Contato;
    
    @session_start();
    
    new Atualizar();
    
    class Atualizar {
    
        function __construct() {
            ob_start();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            	if (isset($_FILES['imagem1'])) {
					echo Controller_Atualizar::Salvar_Imagem_TMP($_FILES['imagem1']);
				} else if (isset($_POST['del_img'])) {
					Controller_Atualizar::Deletar_Imagem();
				} else {
                	$this->Verificar_Evento();
            	}
			} else {
				Controller_Atualizar::Deletar_Imagem();
				unset($_SESSION['imagem_tmp']);
			}
        }
        
        private $form_atualizar;
        
        private function Verificar_Evento() {
            $this->form_atualizar = array();
            
            if (isset($_POST['restaurar_login'])) {
                $this->Restaurar_Login();
            } else if (isset($_POST['salvar_login'])) {
                $this->Atualizar_Login();
            } else if (isset($_POST['restaurar_dadosusuario'])) {
                $this->Restaurar_DadosUsuario();
            } else if (isset($_POST['salvar_dadosusuario'])) {
                $this->Atualizar_DadosUsuario();
            } else if (isset($_POST['restaurar_contato'])) {
                $this->Restaurar_Contato();
            } else if (isset($_POST['salvar_contato'])) {
                $this->Atualizar_Contato();
            } else {
                $this->Salvar_Contato();
                $this->Salvar_Dados_Usuario();
                $this->Salvar_Login();
                $_SESSION['form_atualizar'] = $this->form_atualizar;
                header("location: /usuario/meu-perfil/meus-dados/atualizar/");
            }
            
            $_SESSION['form_atualizar'] = $this->form_atualizar;
        }
        
        private function Atualizar_Login() {
            $usuario = new Usuario();
            
            $usuario->set_id(unserialize($_SESSION['usuario'])->get_id());
            $usuario->set_nome($_POST["nome"]);
            $usuario->set_senha(unserialize($_SESSION['usuario'])->get_senha());
			$usuario->set_ultimo_login(unserialize($_SESSION['usuario'])->get_ultimo_login());
            
			if ($_POST['confemail'] == $_POST['email']) {
				$usuario->set_email($_POST['email']);
			} else if (isset($_POST['confemail']) AND empty($_POST['email'])) {
				$usuario->set_email("erro1");
			} else if (isset($_POST['email']) AND empty($_POST['confemail'])) {
				$usuario->set_email("erro2");
			} else {
				$usuario->set_email("erro");
			}
			
            Controller_Atualizar::Atualizar_Usuario($usuario);
            
            $this->Salvar_Contato();
            $this->Salvar_Dados_Usuario();
            header("location: /usuario/meu-perfil/meus-dados/atualizar/");
        }
        
        private function Atualizar_DadosUsuario() {
            $dados_usuario = new Dados_Usuario();
            
            $dados_usuario->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $dados_usuario->set_cpf_cnpj($_POST['cpf_cnpj']);
            $dados_usuario->set_nome_fantasia($_POST['nomedadosusuario']);
            $dados_usuario->set_site($_POST['site']);
			            
            Controller_Atualizar:: Atualizar_DadosUsuario($dados_usuario);
            
            $this->Salvar_Contato();
            $this->Salvar_Login();
            header("location: /usuario/meu-perfil/meus-dados/atualizar/");
        }
        
        private function Atualizar_Contato() {
            $contato = new Contato();
            
            $contato->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $contato->set_telefone1($_POST['fone1']);
            $contato->set_telefone2($_POST['fone2']);
            $contato->set_email($_POST['emailcontato']);
            
            Controller_Atualizar::Atualizar_Contato($contato);
            
            $this->Salvar_Login();
            $this->Salvar_Dados_Usuario();
            header("location: /usuario/meu-perfil/meus-dados/atualizar/");
        }
        
        private function Restaurar_Login() {
            $this->Salvar_Contato();
            $this->Salvar_Dados_Usuario();
            header("location: /usuario/meu-perfil/meus-dados/atualizar/");
        }
        
        private function Restaurar_DadosUsuario() {
            $this->Salvar_Login();
            $this->Salvar_Contato();
			Controller_Atualizar::Deletar_Imagem();
			unset($_SESSION['imagem_tmp']);
            header("location: /usuario/meu-perfil/meus-dados/atualizar/");
        }
        
        private function Restaurar_Contato() {
            $this->Salvar_Login();
            $this->Salvar_Dados_Usuario();
            header("location: /usuario/meu-perfil/meus-dados/atualizar/");
        }
        
        private function Salvar_Login() {            
            $this->form_atualizar['nome'] = $_POST['nome'];
            $this->form_atualizar['email'] = $_POST['email'];
			$this->form_atualizar['confemail'] = $_POST['confemail'];
        }
        
        private function Salvar_Dados_Usuario() {
            $this->form_atualizar['nomedadosusuario'] = $_POST['nomedadosusuario'];
            $this->form_atualizar['cpf_cnpj'] = $_POST['cpf_cnpj'];
            $this->form_atualizar['site'] = $_POST['site'];
        }
        
        private function Salvar_Contato() {
            $this->form_atualizar['fone1'] = $_POST['fone1'];
            $this->form_atualizar['fone2'] = $_POST['fone2'];
            $this->form_atualizar['emailcontato'] = $_POST['emailcontato'];
        }
        
        private static function Pegar_Valor($quadro, $campo) {
            switch ($quadro) {
                case "login":
                    if ($campo == "nome") {
                        echo Controller_Atualizar::Pegar_Login_Nome();
                    } else if ($campo == "email") {
                        echo Controller_Atualizar::Pegar_Login_Email();
                    } else if ($campo == "confemail") {
                        echo Controller_Atualizar::Pegar_Login_Email();
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
					echo "/resources/img/imagem_Indisponivel.png";
				} else {
					echo Controller_Atualizar::Pegar_Imagem_URL($_SESSION['imagem_tmp']);
				}
			} else {
				$imagem = Controller_Atualizar::Pegar_DadosUsuario_Imagem();
				
				if (isset($imagem)) {
					echo str_replace("@", "200x150", $imagem);
				} else {
					echo "/resources/img/imagem_Indisponivel.png";
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
                    self::Incluir_Classe_Erros_Login($campo);
                    break;
                    
                case "dadosusuario":
                    self::Incluir_Classe_Erros_DadosUsuario($campo);
                    break;
                    
                case "contato":
                    self::Incluir_Classe_Erros_Contato($campo);
                    break;
            }            
        }
        
        private function Incluir_Classe_Erros_Login($campo) {
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
    }
?>