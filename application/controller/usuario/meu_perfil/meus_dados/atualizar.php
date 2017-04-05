<?php
namespace application\controller\usuario\meu_perfil\meus_dados;
	
	require_once RAIZ.'/application/model/util/cpf_cnpj.php';
    require_once RAIZ.'/application/model/object/entidade.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/dao/entidade.php';
	require_once RAIZ.'/application/model/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/atualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
    
	use application\model\util\CPF_CNPJ as Class_CPF_CNPJ;
    use application\model\object\Usuario as Object_Usuario;
    use application\model\object\Entidade as Object_Entidade;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\dao\Entidade as DAO_Entidade;
	use application\model\util\Gerenciar_Imagens;
    use application\view\src\usuario\meu_perfil\meus_dados\Atualizar as View_Atualizar;
    use application\controller\include_page\menu\Usuario as Controller_Usuario;
	
    class Atualizar {

        function __construct() {
			
        }
        
        private $atualizar_form;
        private $atualizar_erros;
        private $atualizar_sucesso;
        private $atualizar_campos;
        private $entidade_form;
        private $usuario_form;
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		        	if (empty($atualizar_form)) {
		        		$this->Deletar_Imagem();
		        		unset($_SESSION['imagem_tmp']);
		        	}
		        	
		        	$this->entidade_form = DAO_Entidade::BuscarPorCOD(unserialize($_SESSION['usuario'])->get_id());
		        	$this->usuario_form = DAO_Usuario::Buscar_Usuario(unserialize($_SESSION['usuario'])->get_id());
		        	
		        	$view = new View_Atualizar($status);
		        	
		        	$view->set_atualizar_campos($this->atualizar_campos);
		        	$view->set_atualizar_erros($this->atualizar_erros);
		        	$view->set_atualizar_form($this->atualizar_form);
		        	$view->set_atualizar_sucesso($this->atualizar_sucesso);
		        	$view->set_entidade_form($this->entidade_form);
		        	$view->set_usuario_form($this->usuario_form);
		        	 
		        	$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public function Verificar_Evento() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			$this->atualizar_form = array();
		        
		        	if (isset($_POST['restaurar_usuario'])) {
		        		$this->Restaurar_Usuario();
		        	} else if (isset($_POST['salvar_usuario'])) {
		        		$this->Atualizar_Usuario();
		        	} else if (isset($_POST['restaurar_entidade'])) {
		        		$this->Restaurar_Entidade();
		        	} else if (isset($_POST['salvar_entidade'])) {
		        		$this->Atualizar_Entidade();
		        	} else {
		        		$this->Salvar_Entidade();
		        		$this->Salvar_Usuario();
		        	}
		        
		        	$this->Carregar_Pagina();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        private function Restaurar_Usuario() : void {
        	$this->Salvar_Entidade();
        }
        
        private function Restaurar_Entidade() : void {
        	$this->Salvar_Usuario();
        	$this->Deletar_Imagem();
        	
        	unset($_SESSION['imagem_tmp']);
        }
        
        private function Salvar_Usuario() : void {
        	$this->atualizar_form['nome'] = $_POST['nome'];
        	$this->atualizar_form['email'] = $_POST['email'];
        	$this->atualizar_form['confemail'] = $_POST['confemail'];
        	$this->atualizar_form['fone1'] = $_POST['fone1'];
        	$this->atualizar_form['fone2'] = $_POST['fone2'];
        	$this->atualizar_form['email_alternativo'] = $_POST['email_alternativo'];
        }
        
        private function Salvar_Entidade() : void {
        	$this->atualizar_form['nome_comercial'] = $_POST['nome_comercial'];
        	$this->atualizar_form['cpf_cnpj'] = $_POST['cpf_cnpj'];
        	$this->atualizar_form['site'] = $_POST['site'];
        }
        
        private function Atualizar_Entidade() : void {
            $this->atualizar_erros = array();
            $this->atualizar_sucesso = array();
            $this->atualizar_campos = array('erro_cpf_cnpj' => "certo");
            
            $entidade = new Object_Entidade();
            
            if (empty($_POST['cpf_cnpj'])) {
                $this->atualizar_erros[] = "Informe um CPF ou CNPJ";
                $this->atualizar_campos['erro_cpf_cnpj'] = "erro";
            } else {
            	$cpf_cnpj = strip_tags($_POST['cpf_cnpj']);
		        $cpf_cnpj = trim($cpf_cnpj);
		        $cpf_cnpj = preg_replace('/[^a-zA-Z0-9]/', "", $cpf_cnpj);
            	 
            	if (filter_var($cpf_cnpj, FILTER_VALIDATE_FLOAT) !== false) {
            		if (strlen($cpf_cnpj) === 11 OR strlen($cpf_cnpj) === 14) {
            			$class_cpf_cnpj = new Class_CPF_CNPJ($cpf_cnpj);
            			
            			if ($class_cpf_cnpj->valida()) {
	            			$retorno = DAO_Entidade::Verificar_CPF_CNPJ($cpf_cnpj);
	            			 
	            			if ($retorno !== false) {
	            				if ($retorno === 0 OR $retorno == unserialize($_SESSION['usuario'])->get_id()) {
	            					$entidade->set_cpf_cnpj($cpf_cnpj);
	            				} else {
	            					$this->atualizar_erros[] = "Este CPF/CNPJ já esta Cadastrado";
	            					$this->atualizar_campos['erro_cpf_cnpj'] = "erro";
	            				}
	            			} else {
	            				$this->atualizar_erros[] = "Erro ao tentar Encontrar CPF/CNPJ";
	            				$this->atualizar_campos['erro_cpf_cnpj'] = "erro";
	            			}
            			} else {
            				$this->atualizar_erros[] = "CPF/CNPJ Inválido";
            				$this->atualizar_campos['erro_cpf_cnpj'] = "erro";
            			}
            		} else {
            			$this->atualizar_erros[] = "CPF/CNPJ, Deve Conter Exatos 11 ou 14 Caracteres";
            			$this->atualizar_campos['erro_cpf_cnpj'] = "erro";
            		}
            	} else {
            		$this->atualizar_erros[] = "CPF/CNPJ, Digite Apenas Numeros";
            		$this->atualizar_campos['erro_cpf_cnpj'] = "erro";
            	}
            }
            
            if (!empty($_POST['nome_comercial'])) {
            	$nome_comercial = strip_tags($_POST['nome_comercial']);
            	
            	if ($nome_comercial === $_POST['nome_comercial']) {
            		$nome_comercial = trim($nome_comercial);
            		$nome_comercial = preg_replace('/\s+/', " ", $nome_comercial);
            		 
            		if (strlen($nome_comercial) <= 150) {
            			$entidade->set_nome_comercial($nome_comercial);
            		} else {
            			$this->atualizar_erros[] = "Nome Comercial, Não pode conter mais de 150 Caracteres";
            			$this->atualizar_campos['erro_nome_comercial'] = "erro";
            		}
            	} else {
            		$this->atualizar_erros[] = "Nome Comercial, Não pode conter Tags de Programação";
            		$this->atualizar_campos['erro_nome_comercial'] = "erro";
            	}
            }
            
            if (!empty($_POST['site'])) {
            	$site = strip_tags($_POST['site']);
            	 
            	if ($site === $_POST['site']) {
            		$site = trim($_POST['site']);
            		$site = preg_replace('/\s+/', "", $site);
            	
            		if (strlen($site) <= 150) {
            			$entidade->set_site($site);
            		} else {
            			$this->atualizar_erros[] = "Site, pode ter no Maximo 150 Caracteres";
            			$this->atualizar_campos['erro_site'] = "erro";
            		}
            	} else {
            		$this->atualizar_erros[] = "Site, Não pode conter Tags de Programação";
            		$this->atualizar_campos['erro_site'] = "erro";
            	}
            }

            if (empty($this->atualizar_erros)) {
            	$entidade->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            	$entidade->set_imagem($this->Salvar_Imagem());
            	
            	if (empty($entidade->get_imagem())) {
            		if (DAO_Entidade::Atualizar_Dados($entidade) === false) {
            			$this->atualizar_erros[] = "Erro ao tentar Atualizar Entidade";
            			$this->atualizar_campos['erro_cpf_cnpj'] = "";
            		} else {
                		$this->atualizar_sucesso[] = "Entidade Atualizada com Sucesso";
                	}
            	} else if ($entidade->get_imagem() == "del") {
            		$entidade->set_imagem(null);
            		
                	if (DAO_Entidade::Atualizar($entidade) === false) {
                		$this->atualizar_erros[] = "Erro ao tentar Atualizar Entidade";
                		$this->atualizar_campos['erro_cpf_cnpj'] = "";
                	} else {
                		$this->atualizar_sucesso[] = "Entidade Atualizada com Sucesso";
                	}
                } else {
                	if (DAO_Entidade::Atualizar($entidade) === false) {
                		$this->atualizar_erros[] = "Erro ao tentar Atualizar Entidade";
                		$this->atualizar_campos['erro_cpf_cnpj'] = "";
                	} else {
                		$this->atualizar_sucesso[] = "Entidade Atualizada com Sucesso";
                	}
                }
            }
            
            $this->Salvar_Usuario();
        }
        
        private function Atualizar_Usuario() : void {
            $this->atualizar_erros = array();
            $this->atualizar_sucesso = array();
            $this->atualizar_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' =>  "certo", 'erro_fone1' => 'certo');
            
            $usuario = new Object_Usuario();
            
            if (empty($_POST['nome'])) {
            	$this->atualizar_erros[] = "Digite Seu Nome Completo";
            	$this->atualizar_campos['erro_nome'] = "erro";
            } else {
            	$nome = strip_tags($_POST['nome']);
            	
            	if ($nome === $_POST['nome']) {
            		$nome = trim($nome);
            		$nome = preg_replace('/\s+/', " ", $nome);
            		
            		if (strlen($nome) <= 150) {
            			if (preg_match("/^([a-zA-Z0-9çÇ ,'-]+)$/", $nome)) {
            				$usuario->set_nome(ucwords(strtolower($nome)));
            			} else {
            				$this->atualizar_erros[] = "O Nome Não Pode Conter Caracteres Especiais";
            				$this->atualizar_campos['erro_nome'] = "erro";
            			}
            		} else {
            			$this->atualizar_erros[] = "O Nome pode ter no maximo 150 Caracteres";
            			$this->atualizar_campos['erro_nome'] = "erro";
            		}
            	} else {
            		$this->atualizar_erros[] = "O Nome Não pode conter Tags de Programação";
            		$this->atualizar_campos['erro_nome'] = "erro";
            	}
            }
            
            if (empty($_POST['confemail']) OR empty($_POST['email'])) {
            	if (empty($_POST['email'])) {
            		$this->atualizar_erros[] = "Preencha o Campo E-Mail";
            		$this->atualizar_campos['erro_email'] = "erro";
            	}
            	
            	if (empty($_POST['confemail'])) {
            		$this->atualizar_erros[] = "Preencha o Campo Comfirmar E-Mail";
            		$this->atualizar_campos['erro_confemail'] = "erro";
            	}
            } else {
            	$confemail = trim($_POST['confemail']);
            	$email = trim($_POST['email']);
            	
            	if ($confemail === $email) {
            		if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            			$retorno = DAO_Usuario::Verificar_Email($email);
            			
            			if ($retorno === 0 OR $retorno == unserialize($_SESSION['usuario'])->get_id()) {
            				if (strlen($email) <= 150) {
            					$usuario->set_email($email);
            				} else {
            					$this->atualizar_erros[] = "O E-Mail pode ter no maximo 150 Caracteres";
            					$this->atualizar_campos['erro_email'] = "erro";
            					$this->atualizar_campos['erro_confemail'] = "erro";
            				}
            			} else {
            				$this->atualizar_erros[] = "Este E-Mail Já Esta Cadastrado";
            				$this->atualizar_campos['erro_email'] = "erro";
            				$this->atualizar_campos['erro_confemail'] = "erro";
            			}
            		} else {
            			$this->atualizar_erros[] = "Este E-Mail Não é Valido";
            			$this->atualizar_campos['erro_email'] = "erro";
            			$this->atualizar_campos['erro_confemail'] = "erro";
            		}
            	} else {
            		$this->atualizar_erros[] = "Digite o E-Mails Duas Vezes Igualmente";
            		$this->atualizar_campos['erro_email'] = "erro";
            		$this->atualizar_campos['erro_confemail'] = "erro";
            	}
            }
            
            if (empty($_POST['fone1'])) {
            	$this->atualizar_erros[] = "Informe um Nº de Telefone para Telefone 1";
            	$this->atualizar_campos['erro_fone1'] = "erro";
            } else {
            	$fone1 = trim($_POST['fone1']);
            	$fone1 = preg_replace('/[^a-zA-Z0-9]/', "", $fone1);
            	
            	if (strlen($fone1) === 11 OR strlen($fone1) === 10) {
            		if (filter_var($fone1, FILTER_VALIDATE_INT)) {
            			$usuario->set_fone1($fone1);
            		} else {
            			$this->atualizar_erros[] = "Telefone-1, Digite Apenas Numeros";
            			$this->atualizar_campos['erro_fone1'] = "erro";
            		}
            	} else {
            		$this->atualizar_erros[] = "Telefone-1 deve conter 10 ou 11 Dígitos";
            		$this->atualizar_campos['erro_fone1'] = "erro";
            	}
            }
            
            if (!empty($_POST['fone2'])) {
            	$fone2 = trim($_POST['fone2']);
            	$fone2 = preg_replace('/[^a-zA-Z0-9]/', "", $fone2);
            	
            	if (strlen($fone2) === 11 OR strlen($fone2) === 10) {
            		if (filter_var($fone2, FILTER_VALIDATE_INT)) {
            			$usuario->set_fone2($fone2);
            		} else {
            			$this->atualizar_erros[] = "Telefone-2, Digite Apenas Numeros";
            			$this->atualizar_campos['erro_fone2'] = "erro";
            		}
            	} else {
            		$this->atualizar_erros[] = "Telefone-2 deve conter 10 ou 11 Dígitos";
            		$this->atualizar_campos['erro_fone2'] = "erro";
            	}
            }
            
            if (!empty($_POST['email_alternativo'])) {
            	$email_alternativo = trim($_POST['email_alternativo']);
            	
            	if (strlen($email_alternativo) <= 150) {
            		if (filter_var($email_alternativo, FILTER_VALIDATE_EMAIL)) {
            			$usuario->set_email_alternativo($email_alternativo);
            		} else {
            			$this->atualizar_erros[] = "Digite um E-Mail Alternativo Valido";
            			$this->atualizar_campos['erro_email_alternativo'] = "erro";
            		}
            	} else {
            		$this->atualizar_erros[] = "E-Mail Alternativo Não pode ter mais de 150 Caracteres";
            		$this->atualizar_campos['erro_email_alternativo'] = "erro";
            	}
            }
            
            if (empty($this->atualizar_erros)) {
            	$usuario->set_id(unserialize($_SESSION['usuario'])->get_id());
            	$usuario->set_senha(unserialize($_SESSION['usuario'])->get_senha());
            	$usuario->set_ultimo_login(unserialize($_SESSION['usuario'])->get_ultimo_login());
            	
                if (DAO_Usuario::Atualizar($usuario) === false) {
                	$this->atualizar_erros[] = "Erro ao tentar Atualizar Usuario";
                	$this->atualizar_campos['erro_nome'] = "";
                	$this->atualizar_campos['erro_email'] = "";
                	$this->atualizar_campos['erro_confemail'] = "";
                } else {
                	$_SESSION['usuario'] = serialize($usuario);
                	
                	$this->atualizar_sucesso[] = "Usuario Atualizado com Sucesso";
                }
            }
            
            $this->Salvar_Entidade();
        }
		
		public function Salvar_Imagem_TMP() : void {
			if (Controller_Usuario::Verificar_Autenticacao()) {
				if (isset($_FILES['imagem']) AND $_FILES['imagem']['error'] === 0) {
					$imagens = new Gerenciar_Imagens();
					
					$imagens->Armazenar_Imagem_Temporaria($_FILES['imagem']);
					
					$_SESSION['imagem_tmp'] = $imagens->get_nome();
					
					echo $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
				} else {
					echo "/application/view/resources/img/imagem_indisponivel.png";
				}
			}
		}
		
		public function Deletar_Imagem() : void {
			if (Controller_Usuario::Verificar_Autenticacao()) {
				if (isset($_SESSION['imagem_tmp'])) {
					if ($_SESSION['imagem_tmp'] != "del") {
						$imagens = new Gerenciar_Imagens();
						
						$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
					}
				}
	
				$_SESSION['imagem_tmp'] = "del";
			}
		}
		
		public static function Pegar_Imagem_URL(?string $nome_imagem = null) : string {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-200x150");
			
			if (isset($caminho_imagem)) {
				return $imagens::Gerar_Data_URL($caminho_imagem);
			} else {
				return "/resources/img/imagem_indisponivel.png";
			}
		}
        
        private function Salvar_Imagem() : ?string {
        	if (isset($_SESSION['imagem_tmp'])) {
        		$imagens = new Gerenciar_Imagens();
				
        		if ($_SESSION['imagem_tmp'] == "del") {
					$imagens->Deletar_Imagem_Usuario();
        			return "del";
        		} else {
					$img_link = $imagens->Atualizar_Imagem_Usuario($_SESSION['imagem_tmp']);
					unset($_SESSION['imagem_tmp']);
					return $img_link;
				}
			} else {
				return null;
			}
        }
    }
?>