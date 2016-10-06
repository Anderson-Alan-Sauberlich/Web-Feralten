<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once RAIZ.'/application/model/object/dados_usuario.php';
    require_once RAIZ.'/application/model/object/endereco.php';
    require_once RAIZ.'/application/model/object/contato.php';
    require_once RAIZ.'/application/model/dao/contato.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
	require_once RAIZ.'/application/model/dao/dados_usuario.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
	require_once RAIZ.'/application/model/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/concluir.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
    
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\object\Endereco as Object_Endereco;
    use application\model\object\Contato as Object_Contato;
    use application\model\dao\Contato as DAO_Contato;
	use application\model\dao\Dados_Usuario as DAO_Dados_Usuario;
	use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Estado as DAO_Estado;
    use application\model\dao\Cidade as DAO_Cidade;
    use application\model\util\Gerenciar_Imagens;
	use application\view\src\usuario\meu_perfil\meus_dados\Concluir as View_Concluir;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
    
    @session_start();

    class Concluir {
		
        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
        			new View_Concluir($status);
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public static function Concluir_Cadastro() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
		           	$erros_concluir = array();
		            $cnclr_campos = array('erro_fone1' => "certo", 'erro_cidade' => "certo", 'erro_estado' => "certo", 'erro_numero' => "certo",
		            					  'erro_cep' => "certo", 'erro_bairro' => "certo", 'erro_rua' => "certo", 'erro_cpf_cnpj' => "certo");
		            
		            $contato = new Object_Contato();
		            $endereco = new Object_Endereco();
		            $dados_usuario = new Object_Dados_Usuario();
		            
		            if (empty($_POST['fone1'])) {
		                $erros_concluir[] = "Informe um Nº de Telefone para Telefone-1";
		                $cnclr_campos['erro_fone1'] = "erro";
		            } else {
		            	$telefone1 = trim($_POST['fone1']);
		            	
		            	if (strlen($telefone1) == 10) {
		            		if (filter_var($telefone1, FILTER_VALIDATE_INT)) {
		            			$contato->set_telefone1($telefone1);
		            		} else {
		            			$erros_concluir[] = "Telefone-1, Digite Apenas Numeros";
		            			$cnclr_campos['erro_fone1'] = "erro";
		            		}
		            	} else {
		            		$erros_concluir[] = "Telefone-1 deve conter 10 Numeros";
		            		$cnclr_campos['erro_fone1'] = "erro";
		            	}
		            }
		            
		            if (!empty($_POST['fone2'])) {
		            	$telefone2 = trim($_POST['fone2']);
		            	 
		            	if (strlen($telefone2) == 10) {
		            		if (filter_var($telefone2, FILTER_VALIDATE_INT)) {
		            			$contato->set_telefone2($telefone2);
		            		} else {
		            			$erros_concluir[] = "Telefone-2, Digite Apenas Numeros";
		            			$cnclr_campos['erro_fone2'] = "erro";
		            		}
		            	} else {
		            		$erros_concluir[] = "Telefone-2 deve conter 10 Numeros";
		            		$cnclr_campos['erro_fone2'] = "erro";
		            	}
		            }
		            
		            if (!empty($_POST['emailcontato'])) {
		            	$emailcontato = trim($_POST['emailcontato']);
		            	
		            	if (strlen($emailcontato) <= 150) {
			            	if (filter_var($emailcontato, FILTER_VALIDATE_EMAIL)) {
			            		$contato->set_email($emailcontato);
			            	} else {
			            		$erros_concluir[] = "Digite um E-Mail Alternativo Valido";
			            		$cnclr_campos['erro_emailcontato'] = "erro";
			            	}
		            	} else {
		            		$erros_concluir[] = "E-Mail Alternativo Não pode ter mais de 150 Caracteres";
		            		$cnclr_campos['erro_emailcontato'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cidade']) OR $_POST['cidade'] <= 0) {
		                $erros_concluir[] = "Seleciona sua Cidade";
		                $cnclr_campos['erro_cidade'] = "erro";
		            } else {
		            	$endereco->set_cidade_id($_POST['cidade']);
		            }
		            
		            if (empty($_POST['estado']) OR $_POST['estado'] <= 0) {
		                $erros_concluir[] = "Seleciona seu Estado";
		                $cnclr_campos['erro_estado'] = "erro";
		            } else {
		            	$endereco->set_estado_id($_POST['estado']);
		            }
		            
		            if (empty($_POST['numero'])) {
		                $erros_concluir[] = "Informe o Numero do seu Endereço";
		                $cnclr_campos['erro_numero'] = "erro";
		            } else {
		            	$numero = strip_tags($_POST['numero']);
		            	
		            	if ($numero === $_POST['numero']) {
			            	$numero = trim($numero);
			            	
			            	if (strlen($emailcontato) <= 10) {
			            		$endereco->set_numero($numero);
			            	} else {
			            		$erros_concluir[] = "Numero do Estabelecimento, Não pode conter mais de 10 Caracteres";
			            		$cnclr_campos['erro_numero'] = "erro";
			            	}
		            	} else {
		            		$erros_concluir[] = "Numero do Estabelecimento, Não pode conter Tags de Programação";
		            		$cnclr_campos['erro_numero'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cep'])) {
		                $erros_concluir[] = "Informe seu CEP";
		                $cnclr_campos['erro_cep'] = "erro";
		            } else {
		            	if (strlen($_POST['cep']) === 8) {
			            	if (filter_var($_POST['cep'], FILTER_VALIDATE_INT)) {
			            		$endereco->set_cep($_POST['cep']);
			            	} else {
			            		$erros_concluir[] = "CEP, Digite Apenas os Numeros";
			            		$cnclr_campos['erro_cep'] = "erro";
			            	}
		            	} else {
		            		$erros_concluir[] = "CEP Deve conter 8 Numeros";
		            		$cnclr_campos['erro_cep'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['bairro'])) {
		                $erros_concluir[] = "Informe seu Bairro";
		                $cnclr_campos['erro_bairro'] = "erro";
		            } else {
		            	$bairro = strip_tags($_POST['bairro']);
		            	
		            	if ($bairro === $_POST['bairro']) {
			            	$bairro = trim($bairro);
			            	$bairro = preg_replace('/\s+/', " ", $bairro);
			            	
			            	if (strlen($bairro) <= 45) {
			            		$endereco->set_bairro(ucwords(strtolower($bairro)));
			            	} else {
			            		$erros_concluir[] = "Bairro, Não pode conter mais de 45 Caracteres";
			            		$cnclr_campos['erro_bairro'] = "erro";
			            	}
		            	} else {
		            		$erros_concluir[] = "Bairro, Não pode conter Tags de Programação";
		            		$cnclr_campos['erro_bairro'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['rua'])) {
		                $erros_concluir[] = "Informe sua Rua";
		                $cnclr_campos['erro_rua'] = "erro";
		            } else {
		            	$rua = strip_tags($_POST['rua']);
		            	 
		            	if ($rua === $_POST['rua']) {
		            		$rua = trim($rua);
		            		$rua = preg_replace('/\s+/', " ", $rua);
		            	
		            		if (strlen($rua) <= 150) {
		            			$endereco->set_rua(ucwords(strtolower($rua)));
		            		} else {
		            			$erros_concluir[] = "Rua, Não pode conter mais de 150 Caracteres";
		            			$cnclr_campos['erro_rua'] = "erro";
		            		}
		            	} else {
		            		$erros_concluir[] = "Rua, Não pode conter Tags de Programação";
		            		$cnclr_campos['erro_rua'] = "erro";
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
		            			$erros_concluir[] = "Complemento, Não pode conter mais de 150 Caracteres";
		            			$cnclr_campos['erro_complemento'] = "erro";
		            		}
		            	} else {
		            		$erros_concluir[] = "Complemento, Não pode conter Tags de Programação";
		            		$cnclr_campos['erro_complemento'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cpf_cnpj'])) {
		                $erros_concluir[] = "Informe seu CPF ou CNPJ";
		                $cnclr_campos['erro_cpf_cnpj'] = "erro";
		            } else {
		            	$cpf_cnpj = trim($cpf_cnpj);
		            	$cpf_cnpj = preg_replace('/\s+/', "", $cpf_cnpj);
		            	
	            		if (filter_var($cpf_cnpj, FILTER_VALIDATE_INT)) {
		            		if (strlen($cpf_cnpj) === 14) {
		            			$dados_usuario->set_cpf_cnpj($cpf_cnpj);
		            		} else if (strlen($cpf_cnpj) === 11) {
		            			$dados_usuario->set_cpf_cnpj($cpf_cnpj);
		            		} else {
		            			$erros_concluir[] = "CPF/CNPJ, Deve Conter Exatos 11 ou 14 Caracteres";
		            			$cnclr_campos['erro_cpf_cnpj'] = "erro";
		            		}
	            		} else {
	            			$erros_concluir[] = "CPF/CNPJ, Digite Apenas Numeros";
	            			$cnclr_campos['erro_cpf_cnpj'] = "erro";
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
		            			$erros_concluir[] = "Site, pode ter no Maximo 150 Caracteres";
		            			$cnclr_campos['erro_site'] = "erro";
		            		}
		            	} else {
		            		$erros_concluir[] = "Site, Não pode conter Tags de Programação";
		            		$cnclr_campos['erro_site'] = "erro";
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
		            			$erros_concluir[] = "Nome Fantasia, Não pode conter mais de 45 Caracteres";
		            			$cnclr_campos['erro_nomedadosusuario'] = "erro";
		            		}
		            	} else {
		            		$erros_concluir[] = "Nome Fantasia, Não pode conter Tags de Programação";
		            		$cnclr_campos['erro_nomedadosusuario'] = "erro";
		            	}
		            }
		            
		            if (empty($erros_concluir)) {
		                $dados_usuario->set_imagem(self::Salvar_Imagem());
		            }
		            
		            if (empty($erros_concluir)) {
		            	$contato->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            	$endereco->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            	$dados_usuario->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            	$dados_usuario->set_status_id(1);
		            	$dados_usuario->set_data(date('Y-m-d H:i:s'));
		            	
		                DAO_Dados_Usuario::Inserir($dados_usuario);
		                DAO_Endereco::Inserir($endereco);
		                DAO_Contato::Inserir($contato);
		                
		                return 'certo';
		            } else {
		                $_SESSION['erros_concluir'] = $erros_concluir;
		                $_SESSION['cnclr_campos'] = $cnclr_campos;
		                
		                $form_concluir = array();
		                
		                $form_concluir['fone1'] = trim(strip_tags($_POST['fone1']));
		                $form_concluir['fone2'] = trim(strip_tags($_POST['fone2']));
		                $form_concluir['cidade'] = strip_tags($_POST['cidade']);
		                $form_concluir['estado'] = strip_tags($_POST['estado']);
		                $form_concluir['numero'] = trim(strip_tags($_POST['numero']));
		                $form_concluir['cep'] = strip_tags($_POST['cep']);
		                $form_concluir['rua'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['rua'])))));
		                $form_concluir['complemento'] = ucfirst(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['complemento'])))));
		                $form_concluir['bairro'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['bairro'])))));
		                $form_concluir['cpf_cnpj'] = strip_tags($_POST['cpf_cnpj']);
		                $form_concluir['nomedadosusuario'] = trim(strip_tags($_POST['nomedadosusuario']));
		                $form_concluir['emailcontato'] = trim(strip_tags($_POST['emailcontato']));
		                $form_concluir['site'] = trim(strip_tags($_POST['site']));
		                
		                $_SESSION['form_concluir'] = $form_concluir;
		                
		                return 'erro';
		            }
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public static function Retornar_Cidades_Por_Estado() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
	        	if (isset($_GET['estado'])) {
	        		View_Concluir::Mostrar_Cidades($_GET['estado']);
	        	}
        	} else {
        		return false;
        	}
        }
        
		public static function Salvar_Imagem_TMP() {
			if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
				if (isset($_FILES['imagem'])) {
					$imagens = new Gerenciar_Imagens();
						
					$imagens->Armazenar_Imagem_Temporaria($_FILES['imagem']);
						
					$_SESSION['imagem_tmp'] = $imagens->get_nome();
						
					echo $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
				}
			} else {
				return false;
			}
		}
		
		public static function Deletar_Imagem() {
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
				return "/application/view/resources/img/imagem_Indisponivel.png";
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