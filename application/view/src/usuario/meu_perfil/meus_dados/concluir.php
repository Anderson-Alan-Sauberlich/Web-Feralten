<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;

    require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
    require_once(RAIZ.'/application/model/object/usuario.php');
    require_once(RAIZ.'/application/model/object/dados_usuario.php');
    require_once(RAIZ.'/application/model/object/endereco.php');
    require_once(RAIZ.'/application/model/object/contato.php');
    require_once(RAIZ.'/application/model/object/estado.php');
    require_once(RAIZ.'/application/model/object/cidade.php');
    
    use application\controller\usuario\meu_perfil\meus_dados\Concluir as Controller_Concluir;
    use application\model\object\Usuario as Object_Usuario;
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\object\Endereco as Object_Endereco;
    use application\model\object\Contato as Object_Contato;
    use application\model\object\Estado as Object_Estado;
    use application\model\object\Cidade as Object_Cidade;

    @session_start();

    class Concluir {
            
        function __construct() {
            ob_start();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (isset($_FILES['imagem1'])) {
					echo Controller_Concluir::Salvar_Imagem_TMP($_FILES['imagem1']);
				} else if (isset($_POST['del_img'])) {
					Controller_Concluir::Deletar_Imagem();
				} else if (isset($_POST['concluir'])) {
                    $this->Cadastrar_Dados_Usuario_Endereco();
                } else {
                	self::Mostrar_Cidades();
                }
            }
        }
        
        private function Cadastrar_Dados_Usuario_Endereco() {
            $contato = new Object_Contato();
            $endereco = new Object_Endereco();
            $dados_usuario = new Object_Dados_Usuario();
            
            $contato->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $contato->set_telefone1($_POST['fone1']);
            $contato->set_telefone2($_POST['fone2']);
            $contato->set_email($_POST['emailcontato']);
            
            $endereco->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $endereco->set_cidade_id($_POST['cidade']);
            $endereco->set_estado_id($_POST['estado']);
            $endereco->set_numero($_POST['numero']);
            $endereco->set_cep($_POST['cep']);
            $endereco->set_rua($_POST['rua']);
            $endereco->set_complemento($_POST['complemento']);
            $endereco->set_bairro($_POST['bairro']);
            
            $dados_usuario->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $dados_usuario->set_cpf_cnpj($_POST['cpf_cnpj']);
			$dados_usuario->set_site($_POST['site']);
            $dados_usuario->set_nome_fantasia($_POST['nomedadosusuario']);
            $dados_usuario->set_status_id(1);
            $dados_usuario->set_data(date('Y-m-d H:i:s'));
            
            Controller_Concluir::Cadastrar($contato, $endereco, $dados_usuario);
            
            if (isset($_SESSION['erros_concluir'])) {
            	$this->Salvar_Post();
                header("location: /usuario/meu-perfil/meus-dados/concluir/");
            } else {
				unset($_SESSION['imagem_tmp']);
                header("location: /usuario/meu-perfil/");
            }
        }
        
        private function Salvar_Post() {
            $form_concluir = array();
            
            $form_concluir['fone1'] = $_POST['fone1'];
            $form_concluir['fone2'] = $_POST['fone2'];
            $form_concluir['cidade'] = $_POST['cidade'];
            $form_concluir['estado'] = $_POST['estado'];
            $form_concluir['numero'] = $_POST['numero'];
            $form_concluir['cep'] = $_POST['cep'];
            $form_concluir['rua'] = $_POST['rua'];
            $form_concluir['complemento'] = $_POST['complemento'];
            $form_concluir['bairro'] = $_POST['bairro'];
            $form_concluir['cpf_cnpj'] = $_POST['cpf_cnpj'];
            $form_concluir['nomedadosusuario'] = $_POST['nomedadosusuario'];
            $form_concluir['emailcontato'] = $_POST['emailcontato'];
			$form_concluir['site'] = $_POST['site'];
            
            $_SESSION['form_concluir'] = $form_concluir;
        }
        
        public static function Manter_Valor($campo) {
            if (isset($_SESSION['form_concluir'])) {
                $form_concluir = $_SESSION['form_concluir'];
                
                if (isset($form_concluir[$campo])) {
                    echo $form_concluir[$campo];
                    unset($form_concluir[$campo]);
					if (count($form_concluir) > 0) {
                    	$_SESSION['form_concluir'] = $form_concluir;
					} else {
						unset($_SESSION['form_concluir']);
					}
                }
            }
        }

		public static function Manter_Imagem() {
			if (isset($_SESSION['imagem_tmp'])) {
				echo Controller_Concluir::Pegar_Imagem_URL($_SESSION['imagem_tmp']);
			} else {
				echo "/resources/img/imagem_Indisponivel.png";
			}
		}
        
        public static function Mostrar_Erros() {
            if (isset($_SESSION['erros_concluir'])) {
                $erros_concluir = $_SESSION['erros_concluir'];
                if (isset($erros_concluir)) {
                    echo "<div class=\"container-fluid\"><div class=\"row\">";
                    foreach ($erros_concluir as $value) {
                        echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                    }
                    echo "</div></div>";
                }
                unset($_SESSION['erros_concluir']);
            }
        }
        
        public static function Mostrar_Estados() {
            $estados = Controller_Concluir::Buscar_Todos_Estados();
            
            if (isset($_SESSION['form_concluir']['estado'])) {
		        foreach ($estados as $estado) {
		            if ($_SESSION['form_concluir']['estado'] == $estado->get_id()) {
		                echo "<option selected value=\"". $estado->get_id() . "\">" . $estado->get_uf() . " - " . $estado->get_nome() . "</option>";
		            } else {
		                echo "<option value=\"". $estado->get_id() . "\">" . $estado->get_uf() . " - " . $estado->get_nome() . "</option>";
		            }
		        }
			} else {
		        foreach ($estados as $estado) {
		            echo "<option value=\"". $estado->get_id() . "\">" . $estado->get_uf() . " - " . $estado->get_nome() . "</option>";
		        }
			}
        }
        
        public static function Mostrar_Cidades() {
			$id_estado;
				
			if (isset($_POST['estado'])) {
				$id_estado = $_POST['estado'];
			} else if (isset($_SESSION['form_concluir']['estado'])) {
				$id_estado = $_SESSION['form_concluir']['estado'];
			}
			
			unset($_SESSION['form_concluir']['estado']);
			
            if (isset($id_estado)) {
                $cidades = Controller_Concluir::Buscar_Cidades_Por_Estado($id_estado);
                
				if (isset($_SESSION['form_concluir']['cidade'])) {
	                foreach ($cidades as $cidade) {
	                    if ($_SESSION['form_concluir']['cidade'] == $cidade->get_id()) {
	                        echo "<option selected value=\"". $cidade->get_id() . "\">" . $cidade->get_nome() . "</option>";
	                    } else {
	                        echo "<option value=\"". $cidade->get_id() . "\">" . $cidade->get_nome() . "</option>";
	                    }
	                }
					
					unset($_SESSION['form_concluir']['cidade']);
				} else {
	                foreach ($cidades as $cidade) {
	                    echo "<option value=\"". $cidade->get_id() . "\">" . $cidade->get_nome() . "</option>";
	                }
				}
            }
        }
        
        public static function Incluir_Classe_Erros($campo) {
        	if (isset($_SESSION['cnclr_campos'])) {
	            $cnclr_campos = $_SESSION['cnclr_campos'];
	            
	            switch ($campo) {
	                case "fone1":
	                	if (isset($cnclr_campos['erro_fone1'])) {
		                    if ($cnclr_campos['erro_fone1'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_fone1'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_fone1']);
	                	}
	                	
	                    break;
	                    
	                case "fone2":
	                	if (isset($cnclr_campos['erro_fone2'])) {
		                    if ($cnclr_campos['erro_fone2'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_fone2'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_fone2']);
	                	}
	                	
	                    break;
	                    
	                case "estado":
	                	if (isset($cnclr_campos['erro_estado'])) {
		                    if ($cnclr_campos['erro_estado'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_estado'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_estado']);
	                	}
	                	
	                    break;
	                    
	                case "cidade":
	                	if (isset($cnclr_campos['erro_cidade'])) {
		                    if ($cnclr_campos['erro_cidade'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_cidade'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_cidade']);
	                	}
	                	
	                    break;
	                    
	                case "numero":
	                	if (isset($cnclr_campos['erro_numero'])) {
		                    if ($cnclr_campos['erro_numero'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_numero'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_numero']);
	                	}
	                	
	                    break;
	                    
	                case "cep":
	                	if (isset($cnclr_campos['erro_cep'])) {
		                    if ($cnclr_campos['erro_cep'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_cep'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_cep']);
	                	}
	                	
	                    break;
	                    
	                case "bairro":
	                	if (isset($cnclr_campos['erro_bairro'])) {
		                    if ($cnclr_campos['erro_bairro'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_bairro'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_bairro']);
	                	}
	                	
	                    break;
	                    
	                case "complemento":
	                	if (isset($cnclr_campos['erro_complemento'])) {
		                    if ($cnclr_campos['erro_complemento'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_complemento'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_complemento']);
	                	}
	                	
	                    break;
	                    
	                case "rua":
	                	if (isset($cnclr_campos['erro_rua'])) {
		                    if ($cnclr_campos['erro_rua'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_rua'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_rua']);
	                	}
	                	
	                    break;
	                    
	                case "imagem":
	                	if (isset($cnclr_campos['erro_imagem'])) {
		                    if ($cnclr_campos['erro_imagem'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_imagem'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_imagem']);
	                	}
	                	
	                    break;
	                    
	                case "cpf_cnpj":
	                	if (isset($cnclr_campos['erro_cpf_cnpj'])) {
		                    if ($cnclr_campos['erro_cpf_cnpj'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_cpf_cnpj'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_cpf_cnpj']);
	                	}
	                	
	                    break;
	                    
	                case "nomedadosusuario":
	                	if (isset($cnclr_campos['erro_nomedadosusuario'])) {
		                    if ($cnclr_campos['erro_nomedadosusuario'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_nomedadosusuario'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_nomedadosusuario']);
	                	}
	                	
	                    break;
	                    
	                case "emailcontato":
	                	if (isset($cnclr_campos['erro_emailcontato'])) {
		                    if ($cnclr_campos['erro_emailcontato'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($cnclr_campos['erro_emailcontato'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($cnclr_campos['erro_emailcontato']);
	                	}
	                	
	                    break;
	            }
	            
				if (count($cnclr_campos) > 0) {
	            	$_SESSION['cnclr_campos'] = $cnclr_campos;
				} else {
					unset($_SESSION['cnclr_campos']);
				}
        	}
        }
    }
?>