<?php
namespace application\controller\usuario\meu_perfil\meus_dados;
	
	require_once RAIZ.'/application/model/util/cpf_cnpj.php';
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
	require_once RAIZ.'/application/model/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/concluir.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
    
	use application\model\util\CPF_CNPJ as Class_CPF_CNPJ;
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
    use application\model\util\Gerenciar_Imagens;
	use application\view\src\usuario\meu_perfil\meus_dados\Concluir as View_Concluir;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
    
    class Concluir {
		
        function __construct() {
            
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
		            
		            if (empty($_POST['fone1'])) {
		                $concluir_erros[] = "Informe um Nº de Telefone para Telefone-1";
		                $concluir_campos['erro_fone1'] = "erro";
		            } else {
		            	$fone1 = trim($_POST['fone1']);
		            	$fone1 = preg_replace('/[^a-zA-Z0-9]/', "", $fone1);
		            	
		            	if (strlen($fone1) === 11 OR strlen($fone1) === 10) {
		            		if (filter_var($fone1, FILTER_VALIDATE_INT)) {
		            			$usuario->set_fone1($fone1);
		            		} else {
		            			$concluir_erros[] = "Telefone-1, Digite Apenas Numeros";
		            			$concluir_campos['erro_fone1'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Telefone-1 deve conter 10 ou 11 Dígitos";
		            		$concluir_campos['erro_fone1'] = "erro";
		            	}
		            }
		            
		            if (!empty($_POST['fone2'])) {
		            	$fone2 = trim($_POST['fone2']);
		            	$fone2 = preg_replace('/[^a-zA-Z0-9]/', "", $fone2);
		            	 
		            	if (strlen($fone2) === 11 OR strlen($fone2) === 10) {
		            		if (filter_var($fone2, FILTER_VALIDATE_INT)) {
		            			$usuario->set_fone2($fone2);
		            		} else {
		            			$concluir_erros[] = "Telefone-2, Digite Apenas Numeros";
		            			$concluir_campos['erro_fone2'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Telefone-2 deve conter 10 ou 11 Dígitos";
		            		$concluir_campos['erro_fone2'] = "erro";
		            	}
		            }
		            
		            if (!empty($_POST['email_alternativo'])) {
		            	$email_alternativo = trim($_POST['email_alternativo']);
		            	
		            	if (strlen($email_alternativo) <= 150) {
			            	if (filter_var($email_alternativo, FILTER_VALIDATE_EMAIL)) {
			            		$usuario->set_email_alternativo($email_alternativo);
			            	} else {
			            		$concluir_erros[] = "Digite um E-Mail Alternativo Valido";
			            		$concluir_campos['erro_emailcontato'] = "erro";
			            	}
		            	} else {
		            		$concluir_erros[] = "E-Mail Alternativo Não pode ter mais de 150 Caracteres";
		            		$concluir_campos['erro_emailcontato'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cidade']) OR $_POST['cidade'] <= 0) {
		                $concluir_erros[] = "Seleciona sua Cidade";
		                $concluir_campos['erro_cidade'] = "erro";
		            } else {
		            	$cidade = new Object_Cidade();
		            	
		            	$cidade->set_id($_POST['cidade']);
		            	
		            	$endereco->set_cidade($cidade);
		            }
		            
		            if (empty($_POST['estado']) OR $_POST['estado'] <= 0) {
		                $concluir_erros[] = "Seleciona seu Estado";
		                $concluir_campos['erro_estado'] = "erro";
		            } else {
		            	$estado = new Object_Estado();
		            	
		            	$estado->set_id($_POST['estado']);
		            	
		            	$endereco->set_estado($estado);
		            }
		            
		            if (empty($_POST['numero'])) {
		                $concluir_erros[] = "Informe o Numero do seu Endereço";
		                $concluir_campos['erro_numero'] = "erro";
		            } else {
		            	$numero = strip_tags($_POST['numero']);
		            	
		            	if ($numero === $_POST['numero']) {
			            	$numero = trim($numero);
			            	
			            	if (strlen($numero) <= 10) {
			            		$endereco->set_numero($numero);
			            	} else {
			            		$concluir_erros[] = "Numero do Estabelecimento, Não pode conter mais de 10 Caracteres";
			            		$concluir_campos['erro_numero'] = "erro";
			            	}
		            	} else {
		            		$concluir_erros[] = "Numero do Estabelecimento, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_numero'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cep'])) {
		                $concluir_erros[] = "Informe seu CEP";
		                $concluir_campos['erro_cep'] = "erro";
		            } else {
		            	$cep = trim($_POST['cep']);
		            	$cep = preg_replace('/[^a-zA-Z0-9]/', "", $cep);
		            	
		            	if (strlen($cep) === 8) {
			            	if (filter_var($cep, FILTER_VALIDATE_INT)) {
			            		$endereco->set_cep($cep);
			            	} else {
			            		$concluir_erros[] = "CEP, Digite Apenas os Numeros";
			            		$concluir_campos['erro_cep'] = "erro";
			            	}
		            	} else {
		            		$concluir_erros[] = "CEP Deve conter 8 Numeros";
		            		$concluir_campos['erro_cep'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['bairro'])) {
		                $concluir_erros[] = "Informe seu Bairro";
		                $concluir_campos['erro_bairro'] = "erro";
		            } else {
		            	$bairro = strip_tags($_POST['bairro']);
		            	
		            	if ($bairro === $_POST['bairro']) {
			            	$bairro = trim($bairro);
			            	$bairro = preg_replace('/\s+/', " ", $bairro);
			            	
			            	if (strlen($bairro) <= 45) {
			            		$endereco->set_bairro(ucwords(strtolower($bairro)));
			            	} else {
			            		$concluir_erros[] = "Bairro, Não pode conter mais de 45 Caracteres";
			            		$concluir_campos['erro_bairro'] = "erro";
			            	}
		            	} else {
		            		$concluir_erros[] = "Bairro, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_bairro'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['rua'])) {
		                $concluir_erros[] = "Informe sua Rua";
		                $concluir_campos['erro_rua'] = "erro";
		            } else {
		            	$rua = strip_tags($_POST['rua']);
		            	 
		            	if ($rua === $_POST['rua']) {
		            		$rua = trim($rua);
		            		$rua = preg_replace('/\s+/', " ", $rua);
		            	
		            		if (strlen($rua) <= 150) {
		            			$endereco->set_rua(ucwords(strtolower($rua)));
		            		} else {
		            			$concluir_erros[] = "Rua, Não pode conter mais de 150 Caracteres";
		            			$concluir_campos['erro_rua'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Rua, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_rua'] = "erro";
		            	}
		            }
		            
		            if (!empty($_POST['complemento'])) {
		            	$complemento = strip_tags($_POST['complemento']);
		            	
		            	if ($complemento === $_POST['complemento']) {
		            		$complemento = trim($complemento);
		            		$complemento = preg_replace('/\s+/', " ", $complemento);
		            		 
		            		if (strlen($complemento) <= 150) {
		            			$endereco->set_complemento(ucfirst(strtolower($complemento)));
		            		} else {
		            			$concluir_erros[] = "Complemento, Não pode conter mais de 150 Caracteres";
		            			$concluir_campos['erro_complemento'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Complemento, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_complemento'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cpf_cnpj'])) {
		                $concluir_erros[] = "Informe seu CPF ou CNPJ";
		                $concluir_campos['erro_cpf_cnpj'] = "erro";
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
		            
		            if (!empty($_POST['site'])) {
		            	$site = strip_tags($_POST['site']);
		            	
		            	if ($site === $_POST['site']) {
		            		$site = trim($_POST['site']);
		            		$site = preg_replace('/\s+/', "", $site);
		            		
		            		if (strlen($site) <= 150) {
		            			$entidade->set_site($site);
		            		} else {
		            			$concluir_erros[] = "Site, pode ter no Maximo 150 Caracteres";
		            			$concluir_campos['erro_site'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Site, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_site'] = "erro";
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
		            			$concluir_erros[] = "Nome Comercial, Não pode conter mais de 45 Caracteres";
		            			$concluir_campos['erro_nome_comercial'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Nome Comercial, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_nome_comercial'] = "erro";
		            	}
		            }
		            
		            if (empty($concluir_erros)) {
		            	$usuario->set_id(unserialize($_SESSION['usuario'])->get_id());
		            	
		            	if (DAO_Usuario::Atualizar_Contato($usuario) !== false) {
		            		$entidade->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
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
		            	return 'certo';
		            } else {
		            	$concluir_form = array();
		            	
		            	$concluir_form['fone1'] = trim(strip_tags($_POST['fone1']));
		            	$concluir_form['fone2'] = trim(strip_tags($_POST['fone2']));
		            	$concluir_form['cidade'] = strip_tags($_POST['cidade']);
		            	$concluir_form['estado'] = strip_tags($_POST['estado']);
		            	$concluir_form['numero'] = trim(strip_tags($_POST['numero']));
		            	$concluir_form['cep'] = strip_tags($_POST['cep']);
		            	$concluir_form['rua'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['rua'])))));
		            	$concluir_form['complemento'] = ucfirst(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['complemento'])))));
		            	$concluir_form['bairro'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['bairro'])))));
		            	$concluir_form['cpf_cnpj'] = strip_tags($_POST['cpf_cnpj']);
		            	$concluir_form['nome_comercial'] = trim(strip_tags($_POST['nome_comercial']));
		            	$concluir_form['email_alternativo'] = trim(strip_tags($_POST['email_alternativo']));
		            	$concluir_form['site'] = trim(strip_tags($_POST['site']));
		            	
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
	        	if (isset($_GET['estado'])) {
	        		View_Concluir::Mostrar_Cidades($_GET['estado']);
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