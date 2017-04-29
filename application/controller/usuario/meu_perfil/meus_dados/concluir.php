<?php
namespace application\controller\usuario\meu_perfil\meus_dados;
	
	require_once RAIZ.'/application/model/common/util/login_session.php';
	require_once RAIZ.'/application/model/common/util/cpf_cnpj.php';
	require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/model/object/entidade.php';
    require_once RAIZ.'/application/model/object/endereco.php';
    require_once RAIZ.'/application/model/object/cidade.php';
    require_once RAIZ.'/application/model/object/estado.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/dao/entidade.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
	require_once RAIZ.'/application/model/common/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/concluir.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	require_once RAIZ.'/application/controller/usuario/login.php';
    
	use application\model\common\util\Login_Session;
	use application\model\common\util\CPF_CNPJ;
	use application\model\common\util\Gerenciar_Imagens;
	use application\model\object\usuario as Object_Usuario;
    use application\model\object\Entidade as Object_Entidade;
    use application\model\object\Endereco as Object_Endereco;
    use application\model\object\Cidade as Object_Cidade;
    use application\model\object\Estado as Object_Estado;
    use application\model\dao\Usuario as DAO_Usuario;
	use application\model\dao\Entidade as DAO_Entidade;
	use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Estado as DAO_Estado;
    use application\model\dao\Cidade as DAO_Cidade;
	use application\view\src\usuario\meu_perfil\meus_dados\Concluir as View_Concluir;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	use application\controller\usuario\Login as Controller_Login;
    
    class Concluir {
		
        function __construct() {
            
        }
        
        private $fone1;
        private $fone2;
        private $email_alternativo;
        private $estado;
        private $cidade;
        private $numero;
        private $cep;
        private $bairro;
        private $rua;
        private $complemento;
        private $cpf_cnpj;
        private $site;
        private $nome_comercial;
        
        public function set_fone1($fone1) {
        	$this->fone1 = $fone1;
        }
        
        public function set_fone2($fone2 = null) {
        	$this->fone2 = $fone2;
        }
        
        public function set_email_alternativo($email_alternativo = null) {
        	$this->email_alternativo = $email_alternativo;
        }
        
        public function set_estado($estado) {
        	$this->estado = $estado;
        }
        
        public function set_cidade($cidade) {
        	$this->cidade = $cidade;
        }
        
        public function set_numero($numero) {
        	$this->numero = $numero;
        }
        
        public function set_cep($cep) {
        	$this->cep = $cep;
        }
        
        public function set_bairro($bairro) {
        	$this->bairro = $bairro;
        }
        
        public function set_rua($rua) {
        	$this->rua = $rua;
        }
        
        public function set_complemento($complemento = null) {
        	$this->complemento = $complemento;
        }
        
        public function set_cpf_cnpj($cpf_cnpj) {
        	$this->cpf_cnpj = $cpf_cnpj;
        }
        
        public function set_site($site = null) {
        	$this->site = $site;
        }
        
        public function set_nome_comercial($nome_comercial = null) {
        	$this->nome_comercial = $nome_comercial;
        }
        
        public function Carregar_Pagina(?array $concluir_erros = null, ?array $concluir_campos = null, ?array $concluir_form = null) {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
        			$view = new View_Concluir($status);
        			
        			$view->set_concluir_campos($concluir_campos);
        			$view->set_concluir_erros($concluir_erros);
        			$view->set_concluir_form($concluir_form);
        			 
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public function Concluir_Cadastro() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
		           	$concluir_erros = array();
		            $concluir_campos = array('erro_fone1' => "certo", 'erro_cidade' => "certo", 'erro_estado' => "certo", 'erro_numero' => "certo",
		            					  'erro_cep' => "certo", 'erro_bairro' => "certo", 'erro_rua' => "certo", 'erro_cpf_cnpj' => "certo");
		            
		            $usuario = new Object_Usuario();
		            $entidade = new Object_Entidade();
		            $endereco = new Object_Endereco();
		            
		            if (empty($this->fone1)) {
		                $concluir_erros[] = "Informe um Nº de Telefone para Telefone-1";
		                $concluir_campos['erro_fone1'] = "erro";
		            } else {
		            	$this->fone1 = trim($this->fone1);
		            	$this->fone1 = preg_replace('/[^a-zA-Z0-9]/', "", $this->fone1);
		            	
		            	if (strlen($this->fone1) === 11 OR strlen($this->fone1) === 10) {
		            		if (filter_var($this->fone1, FILTER_VALIDATE_INT)) {
		            			$usuario->set_fone1($this->fone1);
		            		} else {
		            			$concluir_erros[] = "Telefone-1, Digite Apenas Numeros";
		            			$concluir_campos['erro_fone1'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Telefone-1 deve conter 10 ou 11 Dígitos";
		            		$concluir_campos['erro_fone1'] = "erro";
		            	}
		            }
		            
		            if (!empty($this->fone2)) {
		            	$this->fone2 = trim($this->fone2);
		            	$this->fone2 = preg_replace('/[^a-zA-Z0-9]/', "", $this->fone2);
		            	 
		            	if (strlen($this->fone2) === 11 OR strlen($this->fone2) === 10) {
		            		if (filter_var($this->fone2, FILTER_VALIDATE_INT)) {
		            			$usuario->set_fone2($this->fone2);
		            		} else {
		            			$concluir_erros[] = "Telefone-2, Digite Apenas Numeros";
		            			$concluir_campos['erro_fone2'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Telefone-2 deve conter 10 ou 11 Dígitos";
		            		$concluir_campos['erro_fone2'] = "erro";
		            	}
		            }
		            
		            if (!empty($this->email_alternativo)) {
		            	$this->email_alternativo = trim($this->email_alternativo);
		            	
		            	if (strlen($this->email_alternativo) <= 150) {
		            		if (filter_var($this->email_alternativo, FILTER_VALIDATE_EMAIL)) {
		            			$usuario->set_email_alternativo($this->email_alternativo);
			            	} else {
			            		$concluir_erros[] = "Digite um E-Mail Alternativo Valido";
			            		$concluir_campos['erro_emailcontato'] = "erro";
			            	}
		            	} else {
		            		$concluir_erros[] = "E-Mail Alternativo Não pode ter mais de 150 Caracteres";
		            		$concluir_campos['erro_emailcontato'] = "erro";
		            	}
		            }
		            
		            if (empty($this->cidade)) {
		                $concluir_erros[] = "Selecione sua Cidade";
		                $concluir_campos['erro_cidade'] = "erro";
		            } else {
		            	if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
			            	$cidade = new Object_Cidade();
			            	
			            	$cidade->set_id($this->cidade);
			            	
			            	$endereco->set_cidade($cidade);
		            	} else {
		            		$concluir_erros[] = "Selecione uma Cidade Válida";
		            		$concluir_campos['erro_cidade'] = "erro";
		            	}
		            }
		            
		            if (empty($this->estado)) {
		                $concluir_erros[] = "Selecione seu Estado";
		                $concluir_campos['erro_estado'] = "erro";
		            } else {
		            	if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
		            		$estado = new Object_Estado();
		            		
		            		$estado->set_id($this->estado);
		            		
		            		$endereco->set_estado($estado);
		            	} else {
		            		$concluir_erros[] = "Selecione um Estado Válido";
		            		$concluir_campos['erro_estado'] = "erro";
		            	}
		            }
		            
		            if (empty($this->numero)) {
		                $concluir_erros[] = "Informe o Numero do seu Endereço";
		                $concluir_campos['erro_numero'] = "erro";
		            } else {
		            	$numero = strip_tags($this->numero);
		            	
		            	if ($numero === $this->numero) {
		            		$this->numero = trim($this->numero);
			            	
		            		if (strlen($this->numero) <= 10) {
		            			$endereco->set_numero($this->numero);
			            	} else {
			            		$concluir_erros[] = "Numero do Estabelecimento, Não pode conter mais de 10 Caracteres";
			            		$concluir_campos['erro_numero'] = "erro";
			            	}
		            	} else {
		            		$concluir_erros[] = "Numero do Estabelecimento, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_numero'] = "erro";
		            	}
		            }
		            
		            if (empty($this->cep)) {
		                $concluir_erros[] = "Informe seu CEP";
		                $concluir_campos['erro_cep'] = "erro";
		            } else {
		            	$this->cep = trim($this->cep);
		            	$this->cep = preg_replace('/[^a-zA-Z0-9]/', "", $this->cep);
		            	
		            	if (strlen($this->cep) === 8) {
		            		if (filter_var($this->cep, FILTER_VALIDATE_INT)) {
		            			$endereco->set_cep($this->cep);
			            	} else {
			            		$concluir_erros[] = "CEP, Digite Apenas os Numeros";
			            		$concluir_campos['erro_cep'] = "erro";
			            	}
		            	} else {
		            		$concluir_erros[] = "CEP Deve conter 8 Numeros";
		            		$concluir_campos['erro_cep'] = "erro";
		            	}
		            }
		            
		            if (empty($this->bairro)) {
		                $concluir_erros[] = "Informe seu Bairro";
		                $concluir_campos['erro_bairro'] = "erro";
		            } else {
		            	$bairro = strip_tags($this->bairro);
		            	
		            	if ($bairro === $_POST['bairro']) {
		            		$this->bairro = trim($this->bairro);
		            		$this->bairro = preg_replace('/\s+/', " ", $this->bairro);
			            	
		            		if (strlen($this->bairro) <= 150) {
		            			$endereco->set_bairro(ucwords(strtolower($this->bairro)));
			            	} else {
			            		$concluir_erros[] = "Bairro, Não pode conter mais de 150 Caracteres";
			            		$concluir_campos['erro_bairro'] = "erro";
			            	}
		            	} else {
		            		$concluir_erros[] = "Bairro, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_bairro'] = "erro";
		            	}
		            }
		            
		            if (empty($this->rua)) {
		                $concluir_erros[] = "Informe sua Rua";
		                $concluir_campos['erro_rua'] = "erro";
		            } else {
		            	$rua = strip_tags($this->rua);
		            	 
		            	if ($rua === $this->rua) {
		            		$this->rua = trim($this->rua);
		            		$this->rua = preg_replace('/\s+/', " ", $this->rua);
		            	
		            		if (strlen($this->rua) <= 150) {
		            			$endereco->set_rua(ucwords(strtolower($this->rua)));
		            		} else {
		            			$concluir_erros[] = "Rua, Não pode conter mais de 150 Caracteres";
		            			$concluir_campos['erro_rua'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Rua, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_rua'] = "erro";
		            	}
		            }
		            
		            if (!empty($this->complemento)) {
		            	$complemento = strip_tags($this->complemento);
		            	
		            	if ($complemento === $this->complemento) {
		            		$this->complemento = trim($this->complemento);
		            		$this->complemento = preg_replace('/\s+/', " ", $this->complemento);
		            		 
		            		if (strlen($this->complemento) <= 150) {
		            			$endereco->set_complemento(ucfirst(strtolower($this->complemento)));
		            		} else {
		            			$concluir_erros[] = "Complemento, Não pode conter mais de 150 Caracteres";
		            			$concluir_campos['erro_complemento'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Complemento, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_complemento'] = "erro";
		            	}
		            }
		            
		            if (empty($this->cpf_cnpj)) {
		                $concluir_erros[] = "Informe seu CPF ou CNPJ";
		                $concluir_campos['erro_cpf_cnpj'] = "erro";
		            } else {
		            	$this->cpf_cnpj = trim($this->cpf_cnpj);
		            	$this->cpf_cnpj = preg_replace('/[^a-zA-Z0-9]/', "", $this->cpf_cnpj);
		            	
		            	if (filter_var($this->cpf_cnpj, FILTER_VALIDATE_FLOAT) !== false) {
		            		if (strlen($this->cpf_cnpj) === 11 OR strlen($this->cpf_cnpj) === 14) {
		            			$class_cpf_cnpj = new CPF_CNPJ($this->cpf_cnpj);
		            			 
		            			if ($class_cpf_cnpj->valida()) {
		            				$retorno = DAO_Entidade::Verificar_CPF_CNPJ($this->cpf_cnpj);
			            			
			            			if ($retorno !== false) {
			            				if ($retorno === 0 OR $retorno == Login_Session::get_entidade_id()) {
			            					$entidade->set_cpf_cnpj($this->cpf_cnpj);
			            				} else {
			            					$concluir_erros[] = "Este CPF/CNPJ já esta Cadastrado";
			            					$concluir_campos['erro_cpf_cnpj'] = "erro";
			            				}
			            			} else {
			            				$concluir_erros[] = "Erro ao tentar Encontrar CPF/CNPJ";
			            				$concluir_campos['erro_cpf_cnpj'] = "erro";
			            			}
		            			} else {
		            				$concluir_erros[] = "CPF/CNPJ Inválido";
		            				$concluir_campos['erro_cpf_cnpj'] = "erro";
		            			}
		            		} else {
		            			$concluir_erros[] = "CPF/CNPJ, Deve Conter Exatos 11 ou 14 Caracteres";
		            			$concluir_campos['erro_cpf_cnpj'] = "erro";
		            		}
	            		} else {
	            			$concluir_erros[] = "CPF/CNPJ, Digite Apenas Numeros";
	            			$concluir_campos['erro_cpf_cnpj'] = "erro";
	            		}
		            }
		            
		            if (!empty($this->site)) {
		            	$site = strip_tags($this->site);
		            	
		            	if ($site === $this->site) {
		            		$this->site = trim($this->site);
		            		$this->site = preg_replace('/\s+/', "", $this->site);
		            		
		            		if (strlen($this->site) <= 150) {
		            			$entidade->set_site($this->site);
		            		} else {
		            			$concluir_erros[] = "Site, pode ter no Maximo 150 Caracteres";
		            			$concluir_campos['erro_site'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Site, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_site'] = "erro";
		            	}
		            }
		            
		            if (!empty($this->nome_comercial)) {
		            	$nome_comercial = strip_tags($this->nome_comercial);
		            	 
		            	if ($nome_comercial === $this->nome_comercial) {
		            		$this->nome_comercial = trim($this->nome_comercial);
		            		$this->nome_comercial = preg_replace('/\s+/', " ", $this->nome_comercial);
		            	
		            		if (strlen($this->nome_comercial) <= 150) {
		            			$entidade->set_nome_comercial($this->nome_comercial);
		            		} else {
		            			$concluir_erros[] = "Nome Comercial, Não pode conter mais de 150 Caracteres";
		            			$concluir_campos['erro_nome_comercial'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Nome Comercial, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_nome_comercial'] = "erro";
		            	}
		            }
		            
		            if (empty($concluir_erros)) {
		            	$usuario->set_id(Login_Session::get_usuario_id());
		            	
		            	if (DAO_Usuario::Atualizar_Contato($usuario) !== false) {
		            		$entidade->set_usuario_id(Login_Session::get_usuario_id());
		            		$entidade->set_status_id(1);
		            		$entidade->set_data(date('Y-m-d H:i:s'));
		            		$entidade->set_imagem($this->Salvar_Imagem());
		            		
		            		$retorno = DAO_Entidade::Inserir($entidade);
		            		
			                if ($retorno != false) {
			                	$endereco->set_id(0);
			                	$endereco->set_entidade_id($retorno);
			                	
			                	if (DAO_Endereco::Inserir($endereco) === false) {
			                		$concluir_erros[] = "Erro ao tentar Inserir Endereço do Usuario";
			                	}
			            	} else {
			            		$concluir_erros[] = "Erro ao tentar Inserir Dados do Usuario";
			            	}
		            	} else {
		            		$concluir_erros[] = "Erro ao tentar Inserir Dados do Usuario";
		            	}
		            }
		            
		            if (empty($concluir_erros)) {
		            	Controller_Login::ReAutenticar_Usuario_Logado(Login_Session::get_usuario_id());
		            	
		            	return 'certo';
		            } else {
		            	$concluir_form = array();
		            	
		            	$concluir_form['fone1'] = trim(strip_tags($this->fone1));
		            	$concluir_form['fone2'] = trim(strip_tags($this->fone2));
		            	$concluir_form['cidade'] = strip_tags($this->cidade);
		            	$concluir_form['estado'] = strip_tags($this->estado);
		            	$concluir_form['numero'] = trim(strip_tags($this->numero));
		            	$concluir_form['cep'] = strip_tags($this->cep);
		            	$concluir_form['rua'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($this->rua)))));
		            	$concluir_form['complemento'] = ucfirst(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($this->complemento)))));
		            	$concluir_form['bairro'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($this->bairro)))));
		            	$concluir_form['cpf_cnpj'] = strip_tags($this->cpf_cnpj);
		            	$concluir_form['nome_comercial'] = trim(strip_tags($this->nome_comercial));
		            	$concluir_form['email_alternativo'] = trim(strip_tags($this->email_alternativo));
		            	$concluir_form['site'] = trim(strip_tags($this->site));
		            	
		            	$this->Carregar_Pagina($concluir_erros, $concluir_campos, $concluir_form);
		            }
        		} else {
        			return $status;
        		}
        	} else {
        		return false;
        	}
        }
        
        public function Retornar_Cidades_Por_Estado() : void {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
	        	if (!empty($this->estado)) {
	        		if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
	        			View_Concluir::Mostrar_Cidades($this->estado);
	        		}
	        	}
        	}
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
					$imagens = new Gerenciar_Imagens();
					
					$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
					
					unset($_SESSION['imagem_tmp']);
				}
			}
		}
		
		public static function Pegar_Imagem_URL(?string $nome_imagem = null) : string {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-200x150");
			
			if (isset($caminho_imagem)) {
				return $imagens::Gerar_Data_URL($caminho_imagem);
			} else {
				return "/application/view/resources/img/imagem_indisponivel.png";
			}
		}

        private function Salvar_Imagem() : ?string {
        	if (isset($_SESSION['imagem_tmp'])) {
        		$imagens = new Gerenciar_Imagens();
			
        		$imagem_tmp = $_SESSION['imagem_tmp'];
        		
        		unset($_SESSION['imagem_tmp']);
        		
        		$img_nome = $imagens->Arquivar_Imagem_Usuario($imagem_tmp);
        		
        		if (!empty($img_nome) AND $img_nome != false) {
        			return $img_nome;
        		} else {
        			return null;
        		}
			} else {
				return null;
			}
        }

		public static function Buscar_Todos_Estados() : array {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidades_Por_Estado(?int $id_estado = null) : array {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
    }
?>