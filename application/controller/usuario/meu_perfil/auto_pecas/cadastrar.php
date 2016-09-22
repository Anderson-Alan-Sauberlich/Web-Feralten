<?php
namespace application\controller\usuario\meu_perfil\auto_pecas;

	require_once(RAIZ.'/application/model/object/peca.php');
	require_once(RAIZ.'/application/model/object/lista_pativel.php');
	require_once(RAIZ.'/application/model/object/foto_peca.php');
    require_once(RAIZ.'/application/model/dao/categoria.php');
    require_once(RAIZ.'/application/model/dao/marca.php');
    require_once(RAIZ.'/application/model/dao/modelo.php');
    require_once(RAIZ.'/application/model/dao/versao.php');
    require_once(RAIZ.'/application/model/dao/categoria_compativel.php');
    require_once(RAIZ.'/application/model/dao/marca_compativel.php');
    require_once(RAIZ.'/application/model/dao/modelo_compativel.php');
    require_once(RAIZ.'/application/model/dao/versao_compativel.php');
	require_once(RAIZ.'/application/model/dao/status_peca.php');
	require_once(RAIZ.'/application/model/dao/lista_pativel.php');
	require_once(RAIZ.'/application/model/dao/peca.php');
	require_once(RAIZ.'/application/model/dao/contato.php');
	require_once(RAIZ.'/application/model/dao/endereco.php');
	require_once(RAIZ.'/application/model/dao/foto_peca.php');
	require_once(RAIZ.'/application/model/util/gerenciar_imagens.php');
	require_once(RAIZ.'/application/view/src/usuario/meu_perfil/auto_pecas/cadastrar.php');
	
	use application\model\object\Peca as Object_Peca;
	use application\model\object\Lista_Pativel as Object_Lista_Pativel;
	use application\model\object\Foto_Peca as Object_Foto_Peca;
    use application\model\dao\Categoria as DAO_Categoria;
    use application\model\dao\Marca as DAO_Marca;
    use application\model\dao\Modelo as DAO_Modelo;
    use application\model\dao\Versao as DAO_Versao;
    use application\model\dao\Categoria_Compativel as DAO_Categoria_Compativel;
    use application\model\dao\Marca_Compativel as DAO_Marca_Compativel;
    use application\model\dao\Modelo_Compativel as DAO_Modelo_Compativel;
    use application\model\dao\Versao_Compativel as DAO_Versao_Compativel;
	use application\model\dao\Status_Peca as DAO_Status_Peca;
	use application\model\dao\Peca as DAO_Peca;
	use application\model\dao\Lista_Pativel as DAO_Lista_Pativel;
	use application\model\dao\Contato as DAO_Contato;
	use application\model\dao\Endereco as DAO_Endereco;
	use application\model\dao\Foto_Peca as DAO_Foto_Peca;
	use application\model\util\Gerenciar_Imagens;
	use application\view\src\usuario\meu_perfil\auto_pecas\Cadastrar as View_Cadastrar;
	
	@session_start();
	
    class Cadastrar {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (empty($_SESSION['form_cadastrar_peca'])) {
        		unset($_SESSION['compatibilidade']);
        		self::Deletar_Imagem(123);
        	}
        	
        	new View_Cadastrar();
        }
        
        public static function Verificar_Evento() {
        	if (isset($_POST['salvar'])) {
        		self::Cadastrar_Peca();
        	} else if (isset($_POST['restaurar'])) {
        		unset($_SESSION['form_cadastrar_peca']);
        		unset($_SESSION['compatibilidade']);
        		self::Deletar_Imagem(123);
        	}
        }
        
        public static function Carregar_Compatibilidade() {
        	if (isset($_GET['categoria'])) {
        		if ($_GET['categoria'] == "verificar") {
        			View_Cadastrar::Carregar_Marcas();
        		} else {
        			self::Salvar_Session_Compatibilidade();
        			View_Cadastrar::Carregar_Categorias();
        		}
        	}
        		
        	if (isset($_GET['marca'])) {
        		if ($_GET['marca'] == "verificar") {
        			View_Cadastrar::Carregar_Modelos();
        		} else {
        			self::Salvar_Session_Compatibilidade();
        			View_Cadastrar::Carregar_Marcas();
        		}
        	}
        		
        	if (isset($_GET['modelo'])) {
        		if ($_GET['modelo'] == "verificar") {
        			View_Cadastrar::Carregar_Versoes();
        		} else {
        			self::Salvar_Session_Compatibilidade();
        			View_Cadastrar::Carregar_Modelos();
        		}
        	}
        		
        	if (isset($_GET['versao'])) {
        		if ($_GET['versao'] == "verificar") {
        			View_Cadastrar::Carregar_Anos();
        		} else {
        			self::Salvar_Session_Compatibilidade();
        			View_Cadastrar::Carregar_Versoes();
        		}
        	}
        }
        
        private static function Salvar_Session_Compatibilidade() {
        	$compatibilidade = array();
        		
        	$compatibilidade['categoria'] = array();
        	$compatibilidade['marca'] = array();
        	$compatibilidade['modelo'] = array();
        	$compatibilidade['versao'] = array();
        	$compatibilidade['ano'] = array();
        		
        	if (isset($_SESSION['compatibilidade'])) {
        		$compatibilidade = $_SESSION['compatibilidade'];
        	}
        		
        	if (isset($_GET['categoria'])) {
        		if (isset($compatibilidade['categoria'])) {
        			if (isset($compatibilidade['categoria'][$_GET['categoria']])) {
        				unset($compatibilidade['categoria'][$_GET['categoria']]);
        
        				if (isset($compatibilidade['marca'])) {
        					$marcas = self::Buscar_Marcas_Por_Categoria($_GET['categoria']);
        						
        					foreach ($marcas as $marca) {
        						if (isset($compatibilidade['marca'][$marca->get_id()])) {
        							unset($compatibilidade['marca'][$marca->get_id()]);
        								
        							if (isset($compatibilidade['modelo'])) {
        								$modelos = self::Buscar_Modelos_Por_Marca($marca->get_id());
        
        								foreach ($modelos as $modelo) {
        									if (isset($compatibilidade['modelo'][$modelo->get_id()])) {
        										unset($compatibilidade['modelo'][$modelo->get_id()]);
        
        										if (isset($compatibilidade['versao'])) {
        											$versoes = self::Buscar_Versoes_Por_Modelo($modelo->get_id());
        												
        											foreach ($versoes as $versao) {
        												if (isset($compatibilidade['versao'][$versao->get_id()])) {
        													unset($compatibilidade['versao'][$versao->get_id()]);
        												}
        											}
        										}
        									}
        								}
        							}
        						}
        					}
        				}
        			} else {
        				$compatibilidade['categoria'][$_GET['categoria']] = $_GET['categoria'];
        			}
        		} else {
        			$compatibilidade['categoria'][$_GET['categoria']] = $_GET['categoria'];
        		}
        	}
        		
        	if (isset($_GET['marca'])) {
        		if (isset($compatibilidade['marca'])) {
        			if (isset($compatibilidade['marca'][$_GET['marca']])) {
        				unset($compatibilidade['marca'][$_GET['marca']]);
        
        				if (isset($compatibilidade['modelo'])) {
        					$modelos = self::Buscar_Modelos_Por_Marca($_GET['marca']);
        						
        					foreach ($modelos as $modelo) {
        						if (isset($compatibilidade['modelo'][$modelo->get_id()])) {
        							unset($compatibilidade['modelo'][$modelo->get_id()]);
        								
        							if (isset($compatibilidade['versao'])) {
        								$versoes = self::Buscar_Versoes_Por_Modelo($modelo->get_id());
        
        								foreach ($versoes as $versao) {
        									if (isset($compatibilidade['versao'][$versao->get_id()])) {
        										unset($compatibilidade['versao'][$versao->get_id()]);
        									}
        								}
        							}
        						}
        					}
        				}
        			} else {
        				$compatibilidade['marca'][$_GET['marca']] = $_GET['marca'];
        			}
        		} else {
        			$compatibilidade['marca'][$_GET['marca']] = $_GET['marca'];
        		}
        	}
        		
        	if (isset($_GET['modelo'])) {
        		if (isset($compatibilidade['modelo'])) {
        			if (isset($compatibilidade['modelo'][$_GET['modelo']])) {
        				unset($compatibilidade['modelo'][$_GET['modelo']]);
        
        				if (isset($compatibilidade['versao'])) {
        					$versoes = self::Buscar_Versoes_Por_Modelo($_GET['modelo']);
        						
        					foreach ($versoes as $versao) {
        						if (isset($compatibilidade['versao'][$versao->get_id()])) {
        							unset($compatibilidade['versao'][$versao->get_id()]);
        						}
        					}
        				}
        			} else {
        				$compatibilidade['modelo'][$_GET['modelo']] = $_GET['modelo'];
        			}
        		} else {
        			$compatibilidade['modelo'][$_GET['modelo']] = $_GET['modelo'];
        		}
        	}
        		
        	if (isset($_GET['versao'])) {
        		if (isset($compatibilidade['versao'])) {
        			if (isset($compatibilidade['versao'][$_GET['versao']])) {
        				unset($compatibilidade['versao'][$_GET['versao']]);
        			} else {
        				$compatibilidade['versao'][$_GET['versao']] = $_GET['versao'];
        			}
        		} else {
        			$compatibilidade['versao'][$_GET['versao']] = $_GET['versao'];
        		}
        	}
        		
        	$_SESSION['compatibilidade'] = $compatibilidade;
        }
		
		private static function Cadastrar_Peca() {
			$erros_cadastrar_peca = array();
			$sucesso_cadastrar_peca = array();
			$campos_cadastrar_peca = array('erro_peca' => "certo");
			
			$peca = new Object_Peca();
			$pativeis = array();
				
			$peca->set_data_anuncio(date('Y-m-d H:i:s'));
			$peca->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
				
			if (isset($_POST['descricao'])) {
				$peca->set_descricao($_POST['descricao']);
			}
			if (isset($_POST['status'])) {
				$peca->set_status_id($_POST['status']);
			}
			if (isset($_POST['fabricante'])) {
				$peca->set_fabricante($_POST['fabricante']);
			}
			if (isset($_POST['peca'])) {
				$peca->set_nome($_POST['peca']);
			}
			if (isset($_POST['serie'])) {
				$peca->set_serie($_POST['serie']);
			}
			if (isset($_POST['preco'])) {
				$peca->set_preco($_POST['preco']);
			}
			if (isset($_POST['prioridade'])) {
				$peca->set_prioridade($_POST['prioridade']);
			}
				
			$categorias_compativeis = null;
			$marcas_compativeis = null;
			$modelos_compativeis = null;
			$versoes_compativeis = null;
				
			if (isset($_POST['categoria'])) {
				$categorias_compativeis = self::Buscar_Categorias_Compativeis(current($_POST['categoria']));
			
				if (isset($_POST['marca'])) {
					$marcas_compativeis = self::Buscar_Marcas_Compativeis(current($_POST['marca']));
						
					if (isset($_POST['modelo'])) {
						$modelos_compativeis = self::Buscar_Modelos_Compativeis(current($_POST['modelo']));
			
						if (isset($_POST['versao'])) {
							$versoes_compativeis = self::Buscar_Versoes_Compativeis(current($_POST['versao']));
						}
					}
				}
			}
				
			if (isset($_POST['categoria'])) {
				foreach ($_POST['categoria'] as $categoria_selecionada) {
					if (in_array($categoria_selecionada, $categorias_compativeis)) {
						$pativel = new Object_Lista_Pativel();
						$pativel->set_categoria_id($categoria_selecionada);
			
						if (isset($_POST['marca'])) {
							foreach ($_POST['marca'] as $marca_selecionada) {
								if (in_array($marca_selecionada, $marcas_compativeis)) {
									if (self::Buscar_Categoria_Id_Por_Marca($marca_selecionada) == $categoria_selecionada) {
										$pativel = new Object_Lista_Pativel();
										$pativel->set_categoria_id($categoria_selecionada);
										$pativel->set_marca_id($marca_selecionada);
			
										if (isset($_POST['ano_ma_'.$marca_selecionada.'_de'])) {
											$pativel->set_ano_de($_POST['ano_ma_'.$marca_selecionada.'_de']);
										}
										if (isset($_POST['ano_ma_'.$marca_selecionada.'_ate'])) {
											$pativel->set_ano_ate($_POST['ano_ma_'.$marca_selecionada.'_ate']);
										}
			
										if (isset($_POST['modelo'])) {
											foreach ($_POST['modelo'] as $modelo_selecionado) {
												if (in_array($modelo_selecionado, $modelos_compativeis)) {
													if (self::Buscar_Marca_Id_Por_Modelo($modelo_selecionado) == $marca_selecionada) {
														$pativel = new Object_Lista_Pativel();
														$pativel->set_categoria_id($categoria_selecionada);
														$pativel->set_marca_id($marca_selecionada);
														$pativel->set_modelo_id($modelo_selecionado);
			
														if (isset($_POST['ano_mo_'.$modelo_selecionado.'_de'])) {
															$pativel->set_ano_de($_POST['ano_mo_'.$modelo_selecionado.'_de']);
														}
														if (isset($_POST['ano_mo_'.$modelo_selecionado.'_ate'])) {
															$pativel->set_ano_ate($_POST['ano_mo_'.$modelo_selecionado.'_ate']);
														}
			
														if (isset($_POST['versao'])) {
															foreach ($_POST['versao'] as $versao_selecionada) {
																if (in_array($versao_selecionada, $versoes_compativeis)) {
																	if (self::Buscar_Modelo_Id_Por_Versao($versao_selecionada) == $modelo_selecionado) {
																		$pativel = new Object_Lista_Pativel();
																		$pativel->set_categoria_id($categoria_selecionada);
																		$pativel->set_marca_id($marca_selecionada);
																		$pativel->set_modelo_id($modelo_selecionado);
																		$pativel->set_versao_id($versao_selecionada);
			
																		if (isset($_POST['ano_vs_'.$versao_selecionada.'_de'])) {
																			$pativel->set_ano_de($_POST['ano_vs_'.$versao_selecionada.'_de']);
																		}
																		if (isset($_POST['ano_vs_'.$versao_selecionada.'_ate'])) {
																			$pativel->set_ano_ate($_POST['ano_vs_'.$versao_selecionada.'_ate']);
																		}
			
																		$pativeis[] = $pativel;
																	}
																}
															}
																
															if (empty($pativel->get_versao_id())) {
																$pativeis[] = $pativel;
															}
														} else {
															$pativeis[] = $pativel;
														}
													}
												}
											}
												
											if (empty($pativel->get_modelo_id())) {
												$pativeis[] = $pativel;
											}
										} else {
											$pativeis[] = $pativel;
										}
									}
								}
							}
			
							if (empty($pativel->get_marca_id())) {
								$pativeis[] = $pativel;
							}
						} else {
							$pativeis[] = $pativel;
						}
					}
				}
			}
			
			if (empty($peca->get_nome())) {
				$campos_cadastrar_peca['erro_peca'] = "erro";
				$erros_cadastrar_peca[] = "Digite o Nome da Peça";
			}
			
			if (empty($peca->get_status_id())) {
				$peca->set_status_id(null);
			}
			
			if (empty($peca->get_preco())) {
				$peca->set_preco(null);
			}
			
			if (empty($peca->get_fabricante())) {
				$peca->set_fabricante(null);
			}
			
			if (empty($peca->get_descricao())) {
				$peca->set_descricao(null);
			}
			
			if (empty($peca->get_serie())) {
				$peca->set_serie(null);
			}
			
			if (!empty($peca->get_prioridade())) {
				$peca->set_prioridade(true);
			}
			
			if (empty($erros_cadastrar_peca)) {
				$peca->set_contato_id(DAO_Contato::Buscar_Por_Id_Usuario($peca->get_usuario_id())->get_id());
				$peca->set_endereco_id(DAO_Endereco::Buscar_Por_Id_Usuario($peca->get_usuario_id())->get_id());
				
				$id_peca = DAO_Peca::Inserir($peca);
				
				if (isset($id_peca) AND isset($pativeis)) {
					foreach ($pativeis as $pativel) {
						$pativel->set_peca_id($id_peca);
						DAO_Lista_Pativel::Inserir($pativel);
					}
				}
				
				if (isset($id_peca) AND isset($_SESSION['imagens_tmp'])) {
					$imagens = new Gerenciar_Imagens();
					$diretorios_imagens = array();
					
					$diretorios_imagens = $imagens->Arquivar_Imagem_Peca($_SESSION['imagens_tmp'], $id_peca);
					
					if (isset($diretorios_imagens)) {
						$indice = 0;
						
						foreach ($diretorios_imagens as $diretorio) {
							$foto_peca = new Object_Foto_Peca();
							$indice++;
							
							$foto_peca->set_peca_id($id_peca);
							$foto_peca->set_endereco($diretorio);
							$foto_peca->set_numero($indice);
							
							DAO_Foto_Peca::Inserir($foto_peca);
						}
					}
				}
				
				$sucesso_cadastrar_peca[] = "Peça Cadastrada Com Sucesso";
				$_SESSION['sucesso_cadastrar_peca'] = $sucesso_cadastrar_peca;
			} else {
				$_SESSION['erros_cadastrar_peca'] = $erros_cadastrar_peca;
				$_SESSION['campos_cadastrar_peca'] = $campos_cadastrar_peca;
				
				$form_cadastrar_peca = array();
					
				$form_cadastrar_peca['peca'] = null;
				$form_cadastrar_peca['fabricante'] = null;
				$form_cadastrar_peca['serie'] = null;
				$form_cadastrar_peca['preco'] = null;
				$form_cadastrar_peca['status'] = null;
				$form_cadastrar_peca['prioridade'] = null;
				$form_cadastrar_peca['descricao'] = null;
					
				if (isset($_POST['peca'])) {
					$form_cadastrar_peca['peca'] = $_POST['peca'];
				}
				if (isset($_POST['fabricante'])) {
					$form_cadastrar_peca['fabricante'] = $_POST['fabricante'];
				}
				if (isset($_POST['serie'])) {
					$form_cadastrar_peca['serie'] = $_POST['serie'];
				}
				if (isset($_POST['preco'])) {
					$form_cadastrar_peca['preco'] = $_POST['preco'];
				}
				if (isset($_POST['status'])) {
					$form_cadastrar_peca['status'] = $_POST['status'];
				}
				if (isset($_POST['prioridade'])) {
					$form_cadastrar_peca['prioridade'] = $_POST['prioridade'];
				}
				if (isset($_POST['descricao'])) {
					$form_cadastrar_peca['descricao'] = $_POST['descricao'];
				}
					
				$_SESSION['form_cadastrar_peca'] = $form_cadastrar_peca;
					
				$marcas;
				$modelos;
				$versoes;
				$anos = array();
					
				if (isset($_SESSION['compatibilidade']['marca'])) {
					$marcas = $_SESSION['compatibilidade']['marca'];
				}
				if (isset($_SESSION['compatibilidade']['modelo'])) {
					$modelos = $_SESSION['compatibilidade']['modelo'];
				}
				if (isset($_SESSION['compatibilidade']['versao'])) {
					$versoes = $_SESSION['compatibilidade']['versao'];
				}
					
				if (isset($marcas)) {
					foreach ($marcas as $marca) {
						if (isset($_POST['ano_ma_'.$marca.'_de'])) {
							$anos['ano_ma_'.$marca.'_de'] = $_POST['ano_ma_'.$marca.'_de'];
						}
				
						if (isset($_POST['ano_ma_'.$marca.'_ate'])) {
							$anos['ano_ma_'.$marca.'_ate'] = $_POST['ano_ma_'.$marca.'_ate'];
						}
					}
				}
					
				if (isset($modelos)) {
					foreach ($modelos as $modelo) {
						if (isset($_POST['ano_mo_'.$modelo.'_de'])) {
							$anos['ano_mo_'.$modelo.'_de'] = $_POST['ano_mo_'.$modelo.'_de'];
						}
							
						if (isset($_POST['ano_mo_'.$modelo.'_ate'])) {
							$anos['ano_mo_'.$modelo.'_ate'] = $_POST['ano_mo_'.$modelo.'_ate'];
						}
					}
				}
					
				if (isset($versoes)) {
					foreach ($versoes as $versao) {
						if (isset($_POST['ano_vs_'.$versao.'_de'])) {
							$anos['ano_vs_'.$versao.'_de'] = $_POST['ano_vs_'.$versao.'_de'];
						}
				
						if (isset($_POST['ano_vs_'.$versao.'_ate'])) {
							$anos['ano_vs_'.$versao.'_ate'] = $_POST['ano_vs_'.$versao.'_ate'];
						}
					}
				}
					
				$_SESSION['compatibilidade']['ano'] = $anos;
			}
		}
		
		public static function Salvar_Imagem_TMP() {
			$arquivo = null;
			
			if (isset($_FILES['imagem1'])) {
				$arquivo = $_FILES['imagem1'];
			} else if (isset($_FILES['imagem2'])) {
				$arquivo = $_FILES['imagem2'];
			} else if (isset($_FILES['imagem3'])) {
				$arquivo = $_FILES['imagem3'];
			}
			
			if (isset($arquivo)) {
				$imagens = new Gerenciar_Imagens();
				
				$imagens->Armazenar_Imagem_Temporaria($arquivo);
				
				if (empty($_SESSION['imagens_tmp'][1])) {
					$_SESSION['imagens_tmp'][1] = $imagens->get_nome();
				} else if (empty($_SESSION['imagens_tmp'][2])) {
					$_SESSION['imagens_tmp'][2] = $imagens->get_nome();
				} else if (empty($_SESSION['imagens_tmp'][3])) {
					$_SESSION['imagens_tmp'][3] = $imagens->get_nome();
				}
				
				echo $imagens::Gerar_Data_URL($imagens->get_caminho()."-400x300.".$imagens->get_extensao());
			}
		}
		
		public static function Deletar_Imagem($num_img) {
			if (isset($_SESSION['imagens_tmp'])) {
				if (isset($_SESSION['imagens_tmp'][$num_img]) OR $num_img == 123) {
					$imagens_tmp = $_SESSION['imagens_tmp'];
					$imagens = new Gerenciar_Imagens();
					
					if ($num_img == 123) {
						if (isset($imagens_tmp[1])) {
							$imagens->Deletar_Imagem_Temporaria($imagens_tmp[1]);
						}
						if (isset($imagens_tmp[2])) {
							$imagens->Deletar_Imagem_Temporaria($imagens_tmp[2]);
						}
						if (isset($imagens_tmp[3])) {
							$imagens->Deletar_Imagem_Temporaria($imagens_tmp[3]);
						}
						
						unset($imagens_tmp);
					} else if ($num_img == 1) {
						$imagens->Deletar_Imagem_Temporaria($imagens_tmp[1]);
						
						if (isset($imagens_tmp[2])) {
							$imagens_tmp[1] = $imagens_tmp[2];
							
							if (isset($imagens_tmp[3])) {
								$imagens_tmp[2] = $imagens_tmp[3];
								unset($imagens_tmp[3]);
							} else {
								unset($imagens_tmp[2]);
							}
						} else {
							unset($imagens_tmp[1]);
						}
					} else if ($num_img == 2) {
						$imagens->Deletar_Imagem_Temporaria($imagens_tmp[2]);
						
						if (isset($imagens_tmp[3])) {
							$imagens_tmp[2] = $imagens_tmp[3];
							unset($imagens_tmp[3]);
						} else {
							unset($imagens_tmp[2]);
						}
					} else if ($num_img == 3) {
						$imagens->Deletar_Imagem_Temporaria($imagens_tmp[3]);
						
						unset($imagens_tmp[3]);
					} else {
						$imagens->Deletar_Imagem_Temporaria($num_img);
						
						unset($imagens_tmp[$num_img]);
					}
					
					if (isset($imagens_tmp)) {
						if (count($imagens_tmp) > 0) {
							$_SESSION['imagens_tmp'] = $imagens_tmp;
						} else {
							unset($_SESSION['imagens_tmp']);
						}
					} else {
						unset($_SESSION['imagens_tmp']);
					}
				}
			}
		}

		public static function Pegar_Imagem_URL($nome_imagem) {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-400x300");
			
			if (isset($caminho_imagem)) {
				return $imagens::Gerar_Data_URL($caminho_imagem);
			} else {
				return "/application/view/resources/img/imagem_Indisponivel.png";
			}
		}
		
		public static function Buscar_Categorias() {
			return DAO_Categoria::BuscarTodos();
		}
		
		public static function Buscar_Marcas_Por_Categoria($id_categoria) {
			return DAO_Marca::Buscar_Por_ID_Categorai($id_categoria);
		}
		
		public static function Buscar_Modelos_Por_Marca($id_marca) {
			return DAO_Modelo::Buscar_Por_ID_Marca($id_marca);
		}
		
		public static function Buscar_Versoes_Por_Modelo($id_modelo) {
			return DAO_Versao::Buscar_Por_ID_Modelo($id_modelo);
		}
		
		public static function Buscar_Categoria_Por_Id($id_categoria) {
			return DAO_Categoria::BuscarPorCOD($id_categoria);
		}
		
		public static function Buscar_Marca_Por_Id($id_marca) {
			return DAO_Marca::BuscarPorCOD($id_marca);
		}
		
		public static function Buscar_Modelo_Por_Id($id_modelo) {
			return DAO_Modelo::BuscarPorCOD($id_modelo);
		}
		
		public static function Buscar_Versao_Por_Id($id_versao) {
			return DAO_Versao::BuscarPorCOD($id_versao);
		}
		
		public static function Buscar_Status_Pecas() {
			return DAO_Status_Peca::BuscarTodos();
		}
		
		public static function Buscar_Categoria_Id_Por_Marca($id_marca) {
			return DAO_Marca::Buscar_Categoria_Id($id_marca);
		}
		
		public static function Buscar_Marca_Id_Por_Modelo($id_modelo) {
			return DAO_Modelo::Buscar_Marca_Id($id_modelo);
		}
		
		public static function Buscar_Modelo_Id_Por_Versao($id_versao) {
			return DAO_Versao::Buscar_Modelo_Id($id_versao);
		}
		
		public static function Buscar_Categorias_Compativeis($id_categoria) {
			return DAO_Categoria_Compativel::BuscarPorCOD($id_categoria);
		}
		
		public static function Buscar_Marcas_Compativeis($id_marca) {
			return DAO_Marca_Compativel::BuscarPorCOD($id_marca);
		}
		
		public static function Buscar_Modelos_Compativeis($id_modelo) {
			return DAO_Modelo_Compativel::BuscarPorCOD($id_modelo);
		}
		
		public static function Buscar_Versoes_Compativeis($id_versao) {
			return DAO_Versao_Compativel::BuscarPorCOD($id_versao);
		}
    }
?>