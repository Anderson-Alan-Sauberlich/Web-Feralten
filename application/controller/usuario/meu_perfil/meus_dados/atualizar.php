<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once RAIZ.'/application/model/object/dados_usuario.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/dao/dados_usuario.php';
	require_once RAIZ.'/application/model/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/atualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
    
    use application\model\object\Usuario as Object_Usuario;
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\dao\Dados_Usuario as DAO_Dados_Usuario;
	use application\model\util\Gerenciar_Imagens;
    use application\view\src\usuario\meu_perfil\meus_dados\Atualizar as View_Atualizar;
    use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
    class Atualizar {

        function __construct() {
			
        }
        
        private static $atualizar_form;
        private static $atualizar_erros;
        private static $atualizar_sucesso;
        private static $atualizar_campos;
        private static $dados_usuario_form;
        private static $usuario_form;
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		        	if (empty($atualizar_form)) {
		        		self::Deletar_Imagem();
		        		unset($_SESSION['imagem_tmp']);
		        	}
		        	
		        	self::$dados_usuario_form = DAO_Dados_Usuario::BuscarPorCOD(unserialize($_SESSION['usuario'])->get_id());
		        	self::$usuario_form = DAO_Usuario::Buscar_Usuario(unserialize($_SESSION['usuario'])->get_id());
		        	
		        	$view = new View_Atualizar($status);
		        	
		        	$view->set_atualizar_campos(self::$atualizar_campos);
		        	$view->set_atualizar_erros(self::$atualizar_erros);
		        	$view->set_atualizar_form(self::$atualizar_form);
		        	$view->set_atualizar_sucesso(self::$atualizar_sucesso);
		        	$view->set_dados_usuario_form(self::$dados_usuario_form);
		        	$view->set_usuario_form(self::$usuario_form);
		        	 
		        	$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public static function Verificar_Evento() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		        	self::$atualizar_form = array();
		        
		        	if (isset($_POST['restaurar_login'])) {
		        		self::Restaurar_Usuario();
		        	} else if (isset($_POST['salvar_login'])) {
		        		self::Atualizar_Usuario();
		        	} else if (isset($_POST['restaurar_dadosusuario'])) {
		        		self::Restaurar_DadosUsuario();
		        	} else if (isset($_POST['salvar_dadosusuario'])) {
		        		self::Atualizar_DadosUsuario();
		        	} else {
		        		self::Salvar_Dados_Usuario();
		        		self::Salvar_Usuario();
		        	}
		        
		        	self::Carregar_Pagina();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        private static function Restaurar_Usuario() {
        	self::Salvar_Dados_Usuario();
        }
        
        private static function Restaurar_DadosUsuario() {
        	self::Salvar_Usuario();
        	self::Deletar_Imagem();
        	
        	unset($_SESSION['imagem_tmp']);
        }
        
        private static function Salvar_Usuario() {
        	self::$atualizar_form['nome'] = $_POST['nome'];
        	self::$atualizar_form['email'] = $_POST['email'];
        	self::$atualizar_form['confemail'] = $_POST['confemail'];
        }
        
        private static function Salvar_Dados_Usuario() {
        	self::$atualizar_form['nomedadosusuario'] = $_POST['nomedadosusuario'];
        	self::$atualizar_form['cpf_cnpj'] = $_POST['cpf_cnpj'];
        	self::$atualizar_form['site'] = $_POST['site'];
        	self::$atualizar_form['fone1'] = $_POST['fone1'];
        	self::$atualizar_form['fone2'] = $_POST['fone2'];
        	self::$atualizar_form['emailcontato'] = $_POST['emailcontato'];
        }
        
        private static function Atualizar_DadosUsuario() {
            self::$atualizar_erros = array();
            self::$atualizar_sucesso = array();
            self::$atualizar_campos = array('erro_cpf_cnpj' => "certo");
            
            $dados_usuario = new Object_Dados_Usuario();
            
            if (empty($_POST['fone1'])) {
            	self::$atualizar_erros[] = "Informe um Nº de Telefone para Telefone 1";
            	self::$atualizar_campos['erro_fone1'] = "erro";
            } else {
            	$telefone1 = trim($_POST['fone1']);
            
            	if (strlen($telefone1) == 10) {
            		if (filter_var($telefone1, FILTER_VALIDATE_INT)) {
            			$dados_usuario->set_telefone1($telefone1);
            		} else {
            			self::$atualizar_erros[] = "Telefone-1, Digite Apenas Numeros";
            			self::$atualizar_campos['erro_fone1'] = "erro";
            		}
            	} else {
            		self::$atualizar_erros[] = "Telefone-1 deve conter 10 Numeros";
            		self::$atualizar_campos['erro_fone1'] = "erro";
            	}
            }
            
            if (!empty($_POST['fone2'])) {
            	$telefone2 = trim($_POST['fone2']);
            	 
            	if (strlen($telefone2) == 10) {
            		if (filter_var($telefone2, FILTER_VALIDATE_INT)) {
            			$dados_usuario->set_telefone2($telefone2);
            		} else {
            			self::$atualizar_erros[] = "Telefone-2, Digite Apenas Numeros";
            			self::$atualizar_campos['erro_fone2'] = "erro";
            		}
            	} else {
            		self::$atualizar_erros[] = "Telefone-2 deve conter 10 Numeros";
            		self::$atualizar_campos['erro_fone2'] = "erro";
            	}
            }
            
            if (!empty($_POST['emailcontato'])) {
            	$emailcontato = trim($_POST['emailcontato']);
            
            	if (strlen($emailcontato) <= 150) {
            		if (filter_var($emailcontato, FILTER_VALIDATE_EMAIL)) {
            			$dados_usuario->set_email($emailcontato);
            		} else {
            			self::$atualizar_erros[] = "Digite um E-Mail Alternativo Valido";
            			self::$atualizar_campos['erro_emailcontato'] = "erro";
            		}
            	} else {
            		self::$atualizar_erros[] = "E-Mail Alternativo Não pode ter mais de 150 Caracteres";
            		self::$atualizar_campos['erro_emailcontato'] = "erro";
            	}
            }
            
            if (empty($_POST['cpf_cnpj'])) {
                self::$atualizar_erros[] = "Informe um CPF ou CNPJ";
                self::$atualizar_campos['erro_cpf_cnpj'] = "erro";
            } else {
            	$cpf_cnpj = strip_tags($_POST['cpf_cnpj']);
		        $cpf_cnpj = trim($cpf_cnpj);
		        $cpf_cnpj = preg_replace('/\s+/', "", $cpf_cnpj);
            	 
            	if (filter_var($cpf_cnpj, FILTER_VALIDATE_INT)) {
            		if (strlen($cpf_cnpj) === 11 OR strlen($cpf_cnpj) === 14) {
            			$retorno = DAO_Dados_Usuario::Verificar_CPF_CNPJ($cpf_cnpj);
            			 
            			if ($retorno !== false) {
            				if ($retorno === 0 OR $retorno === unserialize($_SESSION['usuario'])->get_id()) {
            					$dados_usuario->set_cpf_cnpj($cpf_cnpj);
            				} else {
            					self::$atualizar_erros[] = "Este CPF/CNPJ já esta Cadastrado";
            					self::$atualizar_campos['erro_cpf_cnpj'] = "erro";
            				}
            			} else {
            				self::$atualizar_erros[] = "Erro ao tentar Encontrar CPF/CNPJ";
            				self::$atualizar_campos['erro_cpf_cnpj'] = "";
            			}
            		} else {
            			self::$atualizar_erros[] = "CPF/CNPJ, Deve Conter Exatos 11 ou 14 Caracteres";
            			self::$atualizar_campos['erro_cpf_cnpj'] = "erro";
            		}
            	} else {
            		self::$atualizar_erros[] = "CPF/CNPJ, Digite Apenas Numeros";
            		self::$atualizar_campos['erro_cpf_cnpj'] = "erro";
            	}
            }
            
            if (!empty($_POST['nomedadosusuario'])) {
            	$nomedadosusuario = strip_tags($_POST['nomedadosusuario']);
            	
            	if ($nomedadosusuario === $_POST['nomedadosusuario']) {
            		$nomedadosusuario = trim($nomedadosusuario);
            		$nomedadosusuario = preg_replace('/\s+/', " ", $nomedadosusuario);
            		 
            		if (strlen($nomedadosusuario) <= 45) {
            			$dados_usuario->set_nome_fantasia($nomedadosusuario);
            		} else {
            			self::$atualizar_erros[] = "Nome Fantasia, Não pode conter mais de 45 Caracteres";
            			self::$atualizar_campos['erro_nomedadosusuario'] = "erro";
            		}
            	} else {
            		self::$atualizar_erros[] = "Nome Fantasia, Não pode conter Tags de Programação";
            		self::$atualizar_campos['erro_nomedadosusuario'] = "erro";
            	}
            }
            
            if (!empty($_POST['site'])) {
            	$site = strip_tags($_POST['site']);
            	 
            	if ($site === $_POST['site']) {
            		$site = trim($_POST['site']);
            		$site = preg_replace('/\s+/', "", $site);
            	
            		if (strlen($site) <= 150) {
            			$dados_usuario->set_site($site);
            		} else {
            			self::$atualizar_erros[] = "Site, pode ter no Maximo 150 Caracteres";
            			self::$atualizar_campos['erro_site'] = "erro";
            		}
            	} else {
            		self::$atualizar_erros[] = "Site, Não pode conter Tags de Programação";
            		self::$atualizar_campos['erro_site'] = "erro";
            	}
            }

            if (empty(self::$atualizar_erros)) {
            	$dados_usuario->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            	$dados_usuario->set_imagem(self::Salvar_Imagem());
            	
            	if (empty($dados_usuario->get_imagem())) {
            		if (DAO_Dados_Usuario::Atualizar_Dados($dados_usuario) === false) {
            			self::$atualizar_erros[] = "Erro ao tentar Atualizar Dados de Usuario";
            			self::$atualizar_campos['erro_cpf_cnpj'] = "";
            		} else {
                		self::$atualizar_sucesso[] = "Dados de Usuario Atualizados com Sucesso";
                	}
            	} else if ($dados_usuario->get_imagem() == "del") {
            		$dados_usuario->set_imagem(null);
            		
                	if (DAO_Dados_Usuario::Atualizar($dados_usuario) === false) {
                		self::$atualizar_erros[] = "Erro ao tentar Atualizar Dados de Usuario";
                		self::$atualizar_campos['erro_cpf_cnpj'] = "";
                	} else {
                		self::$atualizar_sucesso[] = "Dados de Usuario Atualizados com Sucesso";
                	}
                } else {
                	if (DAO_Dados_Usuario::Atualizar($dados_usuario) === false) {
                		self::$atualizar_erros[] = "Erro ao tentar Atualizar Dados de Usuario";
                		self::$atualizar_campos['erro_cpf_cnpj'] = "";
                	} else {
                		self::$atualizar_sucesso[] = "Dados de Usuario Atualizados com Sucesso";
                	}
                }
            }
            
            self::Salvar_Usuario();
        }
        
        private static function Atualizar_Usuario() {
            self::$atualizar_erros = array();
            self::$atualizar_sucesso = array();
            self::$atualizar_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' =>  "certo");
            
            $usuario = new Object_Usuario();
            
            if (empty($_POST['nome'])) {
            	self::$atualizar_erros[] = "Digite Seu Nome Completo";
            	self::$atualizar_campos['erro_nome'] = "erro";
            } else {
            	$nome = strip_tags($_POST['nome']);
            	 
            	if ($nome === $_POST['nome']) {
            		$nome = trim($nome);
            		$nome = preg_replace('/\s+/', " ", $nome);
            
            		if (strlen($nome) <= 150) {
            			if (preg_match("/^([a-zA-Z0-9çÇ ,'-]+)$/", $nome)) {
            				$usuario->set_nome(ucwords(strtolower($nome)));
            			} else {
            				self::$atualizar_erros[] = "O Nome Não Pode Conter Caracteres Especiais";
            				self::$atualizar_campos['erro_nome'] = "erro";
            			}
            		} else {
            			self::$atualizar_erros[] = "O Nome pode ter no maximo 150 Caracteres";
            			self::$atualizar_campos['erro_nome'] = "erro";
            		}
            	} else {
            		self::$atualizar_erros[] = "O Nome Não pode conter Tags de Programação";
            		self::$atualizar_campos['erro_nome'] = "erro";
            	}
            }
            
            if (empty($_POST['confemail']) OR empty($_POST['email'])) {
            	if (empty($_POST['email'])) {
            		self::$atualizar_erros[] = "Preencha o Campo E-Mail";
            		self::$atualizar_campos['erro_email'] = "erro";
            	}
            	 
            	if (empty($_POST['confemail'])) {
            		self::$atualizar_erros[] = "Preencha o Campo Comfirmar E-Mail";
            		self::$atualizar_campos['erro_confemail'] = "erro";
            	}
            } else {
            	$confemail = trim($_POST['confemail']);
            	$email = trim($_POST['email']);
            
            	if ($confemail === $email) {
            		if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            			$retorno = DAO_Usuario::Verificar_Email($email);
            			
            			if ($retorno === 0 OR $retorno === unserialize($_SESSION['usuario'])->get_id()) {
            				if (strlen($email) <= 150) {
            					$usuario->set_email($email);
            				} else {
            					self::$atualizar_erros[] = "O E-Mail pode ter no maximo 150 Caracteres";
            					self::$atualizar_campos['erro_email'] = "erro";
            					self::$atualizar_campos['erro_confemail'] = "erro";
            				}
            			} else {
            				self::$atualizar_erros[] = "Este E-Mail Já Esta Cadastrado";
            				self::$atualizar_campos['erro_email'] = "erro";
            				self::$atualizar_campos['erro_confemail'] = "erro";
            			}
            		} else {
            			self::$atualizar_erros[] = "Este E-Mail Não é Valido";
            			self::$atualizar_campos['erro_email'] = "erro";
            			self::$atualizar_campos['erro_confemail'] = "erro";
            		}
            	} else {
            		self::$atualizar_erros[] = "Digite o E-Mails Duas Vezes Igualmente";
            		self::$atualizar_campos['erro_email'] = "erro";
            		self::$atualizar_campos['erro_confemail'] = "erro";
            	}
            }
            
            if (empty(self::$atualizar_erros)) {
            	$usuario->set_id(unserialize($_SESSION['usuario'])->get_id());
            	$usuario->set_senha(unserialize($_SESSION['usuario'])->get_senha());
            	$usuario->set_ultimo_login(unserialize($_SESSION['usuario'])->get_ultimo_login());
            	
                if (DAO_Usuario::Atualizar($usuario) === false) {
                	self::$atualizar_erros[] = "Erro ao tentar Atualizar Usuario";
                	self::$atualizar_campos['erro_nome'] = "";
                	self::$atualizar_campos['erro_email'] = "";
                	self::$atualizar_campos['erro_confemail'] = "";
                } else {
                	$_SESSION['usuario'] = serialize($usuario);
                	
                	self::$atualizar_sucesso[] = "Usuario Atualizado com Sucesso";
                }
            }
            
            self::Salvar_Dados_Usuario();
        }
		
		public static function Salvar_Imagem_TMP() {
			if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
				if (isset($_FILES['imagem']) AND $_FILES['imagem']['error'] === 0) {
					$imagens = new Gerenciar_Imagens();
					
					$imagens->Armazenar_Imagem_Temporaria($_FILES['imagem']);
					
					$_SESSION['imagem_tmp'] = $imagens->get_nome();
					
					echo $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
				} else {
					echo "/application/view/resources/img/imagem_indisponivel.png";
				}
			} else {
				return false;
			}
		}
		
		public static function Deletar_Imagem() {
			if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
				if (isset($_SESSION['imagem_tmp'])) {
					if ($_SESSION['imagem_tmp'] != "del") {
						$imagens = new Gerenciar_Imagens();
						
						$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
					}
				}
	
				$_SESSION['imagem_tmp'] = "del";
			} else {
				return false;
			}
		}
		
		public static function Pegar_Imagem_URL($nome_imagem) {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-200x150");
			
			if (isset($caminho_imagem)) {
				return $imagens::Gerar_Data_URL($caminho_imagem);
			} else {
				return "/resources/img/imagem_indisponivel.png";
			}
		}
        
        private static function Salvar_Imagem() {
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