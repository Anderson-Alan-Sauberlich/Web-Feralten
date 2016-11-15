<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once RAIZ.'/application/model/object/dados_usuario.php';
    require_once RAIZ.'/application/model/object/endereco.php';
    require_once RAIZ.'/application/model/object/cidade.php';
    require_once RAIZ.'/application/model/object/estado.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
	require_once RAIZ.'/application/model/dao/dados_usuario.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
	require_once RAIZ.'/application/model/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/concluir.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
    
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\object\Endereco as Object_Endereco;
    use application\model\object\Cidade as Object_Cidade;
    use application\model\object\Estado as Object_Estado;
	use application\model\dao\Dados_Usuario as DAO_Dados_Usuario;
	use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Estado as DAO_Estado;
    use application\model\dao\Cidade as DAO_Cidade;
    use application\model\util\Gerenciar_Imagens;
	use application\view\src\usuario\meu_perfil\meus_dados\Concluir as View_Concluir;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
    
    class Concluir {
		
        function __construct() {
            
        }
        
        public function Carregar_Pagina($concluir_erros = null, $concluir_campos = null, $concluir_form = null) {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
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
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
		           	$concluir_erros = array();
		            $concluir_campos = array('erro_fone1' => "certo", 'erro_cidade' => "certo", 'erro_estado' => "certo", 'erro_numero' => "certo",
		            					  'erro_cep' => "certo", 'erro_bairro' => "certo", 'erro_rua' => "certo", 'erro_cpf_cnpj' => "certo");
		            
		            $endereco = new Object_Endereco();
		            $dados_usuario = new Object_Dados_Usuario();
		            
		            if (empty($_POST['fone1'])) {
		                $concluir_erros[] = "Informe um Nº de Telefone para Telefone-1";
		                $concluir_campos['erro_fone1'] = "erro";
		            } else {
		            	$telefone1 = trim($_POST['fone1']);
		            	
		            	if (strlen($telefone1) == 10) {
		            		if (filter_var($telefone1, FILTER_VALIDATE_INT)) {
		            			$dados_usuario->set_telefone1($telefone1);
		            		} else {
		            			$concluir_erros[] = "Telefone-1, Digite Apenas Numeros";
		            			$concluir_campos['erro_fone1'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Telefone-1 deve conter 10 Numeros";
		            		$concluir_campos['erro_fone1'] = "erro";
		            	}
		            }
		            
		            if (!empty($_POST['fone2'])) {
		            	$telefone2 = trim($_POST['fone2']);
		            	 
		            	if (strlen($telefone2) == 10) {
		            		if (filter_var($telefone2, FILTER_VALIDATE_INT)) {
		            			$dados_usuario->set_telefone2($telefone2);
		            		} else {
		            			$concluir_erros[] = "Telefone-2, Digite Apenas Numeros";
		            			$concluir_campos['erro_fone2'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Telefone-2 deve conter 10 Numeros";
		            		$concluir_campos['erro_fone2'] = "erro";
		            	}
		            }
		            
		            if (!empty($_POST['emailcontato'])) {
		            	$emailcontato = trim($_POST['emailcontato']);
		            	
		            	if (strlen($emailcontato) <= 150) {
			            	if (filter_var($emailcontato, FILTER_VALIDATE_EMAIL)) {
			            		$dados_usuario->set_email($emailcontato);
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
		            	if (strlen($_POST['cep']) === 8) {
			            	if (filter_var($_POST['cep'], FILTER_VALIDATE_INT)) {
			            		$endereco->set_cep($_POST['cep']);
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
		            	$cpf_cnpj = preg_replace('/\s+/', "", $cpf_cnpj);
		            	
	            		if (filter_var($cpf_cnpj, FILTER_VALIDATE_INT)) {
		            		if (strlen($cpf_cnpj) === 11 OR strlen($cpf_cnpj) === 14) {
		            			$retorno = DAO_Dados_Usuario::Verificar_CPF_CNPJ($cpf_cnpj);
		            			
		            			if ($retorno !== false) {
		            				if ($retorno === 0 OR $retorno === unserialize($_SESSION['usuario'])->get_id()) {
		            					$dados_usuario->set_cpf_cnpj($cpf_cnpj);
		            				} else {
		            					$concluir_erros[] = "Este CPF/CNPJ já esta Cadastrado";
		            					$concluir_campos['erro_cpf_cnpj'] = "erro";
		            				}
		            			} else {
		            				$concluir_erros[] = "Erro ao tentar Encontrar CPF/CNPJ";
		            				$concluir_campos['erro_cpf_cnpj'] = "";
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
		            			$dados_usuario->set_site($site);
		            		} else {
		            			$concluir_erros[] = "Site, pode ter no Maximo 150 Caracteres";
		            			$concluir_campos['erro_site'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Site, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_site'] = "erro";
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
		            			$concluir_erros[] = "Nome Fantasia, Não pode conter mais de 45 Caracteres";
		            			$concluir_campos['erro_nomedadosusuario'] = "erro";
		            		}
		            	} else {
		            		$concluir_erros[] = "Nome Fantasia, Não pode conter Tags de Programação";
		            		$concluir_campos['erro_nomedadosusuario'] = "erro";
		            	}
		            }
		            
		            if (empty($concluir_erros)) {
		            	$endereco->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            	$dados_usuario->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            	$dados_usuario->set_status_id(1);
		            	$dados_usuario->set_data(date('Y-m-d H:i:s'));
		            	$dados_usuario->set_imagem($this->Salvar_Imagem());
		            	
		                if (DAO_Dados_Usuario::Inserir($dados_usuario) !== false) {
		                	if (DAO_Endereco::Inserir($endereco) === false) {
		                		$concluir_erros[] = "Erro ao tentar Inserir Endereço do Usuario";
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
		            	$concluir_form['nomedadosusuario'] = trim(strip_tags($_POST['nomedadosusuario']));
		            	$concluir_form['emailcontato'] = trim(strip_tags($_POST['emailcontato']));
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
        
        public function Retornar_Cidades_Por_Estado() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
	        	if (isset($_GET['estado'])) {
	        		View_Concluir::Mostrar_Cidades($_GET['estado']);
	        	}
        	} else {
        		return false;
        	}
        }
        
		public function Salvar_Imagem_TMP() {
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
		
		public function Deletar_Imagem() {
			if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
				if (isset($_SESSION['imagem_tmp'])) {
					$imagens = new Gerenciar_Imagens();
					
					$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
					
					unset($_SESSION['imagem_tmp']);
				}
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
				return "/application/view/resources/img/imagem_indisponivel.png";
			}
		}

        private function Salvar_Imagem() {
        	if (isset($_SESSION['imagem_tmp'])) {
        		$imagens = new Gerenciar_Imagens();
			
        		$imagem_tmp = $_SESSION['imagem_tmp'];
        		
        		unset($_SESSION['imagem_tmp']);
        		
				return $imagens->Arquivar_Imagem_Usuario($imagem_tmp);
			}
        }

		public static function Buscar_Todos_Estados() {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidades_Por_Estado($id_estado) {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
    }
?>