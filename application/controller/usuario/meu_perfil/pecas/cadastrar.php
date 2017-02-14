<?php
namespace application\controller\usuario\meu_perfil\pecas;

	require_once RAIZ.'/application/model/object/peca.php';
	require_once RAIZ.'/application/model/object/endereco.php';
	require_once RAIZ.'/application/model/object/categoria_pativel.php';
	require_once RAIZ.'/application/model/object/marca_pativel.php';
	require_once RAIZ.'/application/model/object/modelo_pativel.php';
	require_once RAIZ.'/application/model/object/versao_pativel.php';
	require_once RAIZ.'/application/model/object/foto_peca.php';
    require_once RAIZ.'/application/model/dao/categoria.php';
    require_once RAIZ.'/application/model/dao/marca.php';
    require_once RAIZ.'/application/model/dao/modelo.php';
    require_once RAIZ.'/application/model/dao/versao.php';
    require_once RAIZ.'/application/model/dao/categoria_compativel.php';
    require_once RAIZ.'/application/model/dao/marca_compativel.php';
    require_once RAIZ.'/application/model/dao/modelo_compativel.php';
    require_once RAIZ.'/application/model/dao/versao_compativel.php';
	require_once RAIZ.'/application/model/dao/status_peca.php';
	require_once RAIZ.'/application/model/dao/categoria_pativel.php';
	require_once RAIZ.'/application/model/dao/marca_pativel.php';
	require_once RAIZ.'/application/model/dao/modelo_pativel.php';
	require_once RAIZ.'/application/model/dao/versao_pativel.php';
	require_once RAIZ.'/application/model/dao/peca.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
	require_once RAIZ.'/application/model/dao/foto_peca.php';
	require_once RAIZ.'/application/model/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/pecas/cadastrar.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	
	use application\model\object\Peca as Object_Peca;
	use application\model\object\Endereco as Object_Endereco;
	use application\model\object\Status_Peca as Object_Status_Peca;
	use application\model\object\Categoria_Pativel as Object_Categoria_Pativel;
	use application\model\object\Marca_Pativel as Object_Marca_Pativel;
	use application\model\object\Modelo_Pativel as Object_Modelo_Pativel;
	use application\model\object\Versao_Pativel as Object_Versao_Pativel;
	use application\model\object\Foto_Peca as Object_Foto_Peca;
	use application\model\object\Dados_Usuario as Object_Dados_Usuario;
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
	use application\model\dao\Categoria_Pativel as DAO_Categoria_Pativel;
	use application\model\dao\Marca_Pativel as DAO_Marca_Pativel;
	use application\model\dao\Modelo_Pativel as DAO_Modelo_Pativel;
	use application\model\dao\Versao_Pativel as DAO_Versao_Pativel;
	use application\model\dao\Endereco as DAO_Endereco;
	use application\model\dao\Foto_Peca as DAO_Foto_Peca;
	use application\model\util\Gerenciar_Imagens;
	use application\view\src\usuario\meu_perfil\pecas\Cadastrar as View_Cadastrar;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
		
    class Cadastrar {

        function __construct() {
            
        }
        
        public function Carregar_Pagina($cadastrar_erros = null, $cadastrar_campos = null, $cadastrar_form = null, $cadastrar_sucesso = null) {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			if (empty($cadastrar_form)) {
        				unset($_SESSION['compatibilidade']);
        				$this->Deletar_Imagem(123);
        			}
        			
        			$view = new View_Cadastrar($status);
        			
        			$view->set_cadastrar_campos($cadastrar_campos);
        			$view->set_cadastrar_erros($cadastrar_erros);
        			$view->set_cadastrar_form($cadastrar_form);
        			$view->set_cadastrar_sucesso($cadastrar_sucesso);
        			 
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
		        	if (isset($_POST['salvar'])) {
		        		$this->Cadastrar_Peca();
		        	} else if (isset($_POST['restaurar'])) {
		        		unset($_SESSION['compatibilidade']);
		        		$this->Deletar_Imagem(123);
		        		$this->Carregar_Pagina();
		        	}
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public function Carregar_Compatibilidade() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
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
        					$id_marcas = self::Buscar_Id_Marcas_Por_Id_Categoria($_GET['categoria']);
        						
        					foreach ($id_marcas as $id_marca) {
        						if (isset($compatibilidade['marca'][$id_marca])) {
        							unset($compatibilidade['marca'][$id_marca]);
        								
        							if (isset($compatibilidade['modelo'])) {
        								$id_modelos = self::Buscar_Id_Modelos_Por_Id_Marca($id_marca);
        
        								foreach ($id_modelos as $id_modelo) {
        									if (isset($compatibilidade['modelo'][$id_modelo])) {
        										unset($compatibilidade['modelo'][$id_modelo]);
        
        										if (isset($compatibilidade['versao'])) {
        											$id_versoes = self::Buscar_Id_Versoes_Por_Id_Modelo($id_modelo);
        												
        											foreach ($id_versoes as $id_versao) {
        												if (isset($compatibilidade['versao'][$id_versao])) {
        													unset($compatibilidade['versao'][$id_versao]);
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
        					$id_modelos = self::Buscar_Id_Modelos_Por_Id_Marca($_GET['marca']);
        						
        					foreach ($id_modelos as $id_modelo) {
        						if (isset($compatibilidade['modelo'][$id_modelo])) {
        							unset($compatibilidade['modelo'][$id_modelo]);
        								
        							if (isset($compatibilidade['versao'])) {
        								$id_versoes = self::Buscar_Id_Versoes_Por_Id_Modelo($id_modelo);
        
        								foreach ($id_versoes as $id_versao) {
        									if (isset($compatibilidade['versao'][$id_versao])) {
        										unset($compatibilidade['versao'][$id_versao]);
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
        					$id_versoes = self::Buscar_Id_Versoes_Por_Id_Modelo($_GET['modelo']);
        						
        					foreach ($id_versoes as $id_versao) {
        						if (isset($compatibilidade['versao'][$id_versao])) {
        							unset($compatibilidade['versao'][$id_versao]);
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
		
		private function Cadastrar_Peca() {
			$cadastrar_erros = array();
			$cadastrar_sucesso = array();
			$cadastrar_campos = array('erro_peca' => "certo");
			
			$peca = new Object_Peca();
			$status = new Object_Status_Peca();
			
			$peca->set_status($status);
				
			if (!empty($_POST['descricao'])) {
				$descricao = strip_tags($_POST['descricao']);
				 
				if ($descricao === $_POST['descricao']) {
					$descricao = trim($descricao);
					$descricao = preg_replace('/\s+/', " ", $descricao);
					 
					if (strlen($descricao) <= 1000) {
						$peca->set_descricao(ucfirst($descricao));
					} else {
						$erros_concluir[] = "Descricao, Não pode conter mais de 1000 Caracteres";
						$cnclr_campos['erro_descricao'] = "erro";
					}
				} else {
					$cadastrar_erros[] = "Descricao, Não pode conter Tags de Programação";
					$cadastrar_campos['erro_descricao'] = "erro";
				}
			}
			
			if (!empty($_POST['status'])) {
				if (filter_var($_POST['status'], FILTER_VALIDATE_INT)) {
					$status->set_id($_POST['status']);
					
					$peca->set_status($status);
				} else {
					$cadastrar_erros[] = "Status, Selecione um Status Valido.";
					$cadastrar_campos['erro_status'] = "erro";
				}
			}
			
			if (!empty($_POST['fabricante'])) {
				$fabricante = strip_tags($_POST['fabricante']);
				
				if ($fabricante === $_POST['fabricante']) {
					$fabricante = trim($fabricante);
					$fabricante = preg_replace('/\s+/', " ", $fabricante);
					 
					if (strlen($fabricante) <= 50) {
						$peca->set_fabricante(ucwords(strtolower($fabricante)));
					} else {
						$cadastrar_erros[] = "Fabricante, Não pode conter mais de 50 Caracteres";
						$cadastrar_campos['erro_fabricante'] = "erro";
					}
				} else {
					$cadastrar_erros[] = "Fabricante, Não pode conter Tags de Programação";
					$cadastrar_campos['erro_fabricante'] = "erro";
				}
			}
			
			if (!empty($_POST['peca'])) {
				$peca_nome = strip_tags($_POST['peca']);
				
				if ($peca_nome === $_POST['peca']) {
					$peca_nome = trim($peca_nome);
					$peca_nome = preg_replace('/\s+/', " ", $peca_nome);
				
					if (strlen($peca_nome) <= 50) {
						$peca->set_nome(ucwords(strtolower($peca_nome)));
					} else {
						$cadastrar_erros[] = "Peca Nome, Não pode conter mais de 50 Caracteres";
						$cadastrar_campos['erro_peca'] = "erro";
					}
				} else {
					$cadastrar_erros[] = "Peca Nome, Não pode conter Tags de Programação";
					$cadastrar_campos['erro_peca'] = "erro";
				}
			} else {
				$cadastrar_campos['erro_peca'] = "erro";
				$cadastrar_erros[] = "Digite o Nome da Peça";
			}
			
			if (!empty($_POST['serie'])) {
				$serie = strip_tags($_POST['serie']);
				
				if ($serie === $_POST['serie']) {
					$serie = trim($serie);
					$serie = preg_replace('/\s+/', " ", $serie);
				
					if (strlen($serie) <= 150) {
						$peca->set_serie($serie);
					} else {
						$cadastrar_erros[] = "Numero de Serie, Não pode conter mais de 150 Caracteres";
						$cadastrar_campos['erro_serie'] = "erro";
					}
				} else {
					$cadastrar_erros[] = "Numero de Serie, Não pode conter Tags de Programação";
					$cadastrar_campos['erro_serie'] = "erro";
				}
			}
			
			if (!empty($_POST['preco'])) {
				if (filter_var($_POST['preco'], FILTER_VALIDATE_FLOAT)) {
					$peca->set_preco($_POST['preco']);
				} else {
					$cadastrar_erros[] = "Digite um Preço Valido para a peça";
					$cadastrar_campos['erro_preco'] = "erro";
				}
			}
			
			if (!empty($_POST['prioridade'])) {
				$peca->set_prioridade(true);
			}
				
			$categorias_compativeis = null;
			$marcas_compativeis = null;
			$modelos_compativeis = null;
			$versoes_compativeis = null;
			
			$categorias_pativeis = array();
			$marcas_pativeis = array();
			$modelos_pativeis = array();
			$versoes_pativeis = array();
				
			if (!empty($_POST['categoria'])) {
				$categorias_compativeis = self::Buscar_Categorias_Compativeis(current($_POST['categoria']));
			
				if (!empty($_POST['marca'])) {
					$marcas_compativeis = self::Buscar_Marcas_Compativeis(current($_POST['marca']));
						
					if (!empty($_POST['modelo'])) {
						$modelos_compativeis = self::Buscar_Modelos_Compativeis(current($_POST['modelo']));
			
						if (!empty($_POST['versao'])) {
							$versoes_compativeis = self::Buscar_Versoes_Compativeis(current($_POST['versao']));
						}
					}
				}
			}
				
			if (!empty($_POST['categoria'])) {
				foreach ($_POST['categoria'] as $categoria_selecionada) {
					if (in_array($categoria_selecionada, $categorias_compativeis)) {
						$categoria_pativel = new Object_Categoria_Pativel();
						$categoria_pativel->set_categoria_id($categoria_selecionada);
						
						$categorias_pativeis[] = $categoria_pativel;
						
						if (!empty($_POST['marca'])) {
							foreach ($_POST['marca'] as $marca_selecionada) {
								if (in_array($marca_selecionada, $marcas_compativeis)) {
									if (self::Buscar_Categoria_Id_Por_Marca($marca_selecionada) == $categoria_selecionada) {
										$marca_pativel = new Object_Marca_Pativel();
										$marca_pativel->set_marca_id($marca_selecionada);
										
										if (!empty($_POST['ano_ma_'.$marca_selecionada.'_de'])) {
											$marca_pativel->set_ano_de($_POST['ano_ma_'.$marca_selecionada.'_de']);
										}
										if (!empty($_POST['ano_ma_'.$marca_selecionada.'_ate'])) {
											$marca_pativel->set_ano_ate($_POST['ano_ma_'.$marca_selecionada.'_ate']);
										}
										
										$marcas_pativeis[] = $marca_pativel;
										
										if (!empty($_POST['modelo'])) {
											foreach ($_POST['modelo'] as $modelo_selecionado) {
												if (in_array($modelo_selecionado, $modelos_compativeis)) {
													if (self::Buscar_Marca_Id_Por_Modelo($modelo_selecionado) == $marca_selecionada) {
														$modelo_pativel = new Object_Modelo_Pativel();
														$modelo_pativel->set_modelo_id($modelo_selecionado);
														
														if (!empty($_POST['ano_mo_'.$modelo_selecionado.'_de'])) {
															$modelo_pativel->set_ano_de($_POST['ano_mo_'.$modelo_selecionado.'_de']);
														}
														if (!empty($_POST['ano_mo_'.$modelo_selecionado.'_ate'])) {
															$modelo_pativel->set_ano_ate($_POST['ano_mo_'.$modelo_selecionado.'_ate']);
														}
														
														$modelos_pativeis[] = $modelo_pativel;
														
														if (!empty($_POST['versao'])) {
															foreach ($_POST['versao'] as $versao_selecionada) {
																if (in_array($versao_selecionada, $versoes_compativeis)) {
																	if (self::Buscar_Modelo_Id_Por_Versao($versao_selecionada) == $modelo_selecionado) {
																		$versao_pativel = new Object_Versao_Pativel();
																		$versao_pativel->set_versao_id($versao_selecionada);
			
																		if (!empty($_POST['ano_vs_'.$versao_selecionada.'_de'])) {
																			$versao_pativel->set_ano_de($_POST['ano_vs_'.$versao_selecionada.'_de']);
																		}
																		if (!empty($_POST['ano_vs_'.$versao_selecionada.'_ate'])) {
																			$versao_pativel->set_ano_ate($_POST['ano_vs_'.$versao_selecionada.'_ate']);
																		}
			
																		$versoes_pativeis[] = $versao_pativel;
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			
			if (empty($cadastrar_erros)) {
				$dados_usuario = new Object_Dados_Usuario();
				
				$dados_usuario->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
				
				$peca->set_dados_usuario($dados_usuario);
				$peca->set_data_anuncio(date('Y-m-d H:i:s'));
				
				$id_endereco = DAO_Endereco::Buscar_Id_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id());
				
				if ($id_endereco === false) {
					$cadastrar_erros[] = "Erro ao tentar adicionar o Endereço do Usuario para a Peça";
					$cadastrar_campos['erro_peca'] = "";
				} else {
					$endereco = new Object_Endereco();
					
					$endereco->set_id($id_endereco);
					
					$peca->set_id(0);
					$peca->set_endereco($endereco);
				}
				
				$id_peca = DAO_Peca::Inserir($peca);
				
				if (!empty($id_peca) AND $id_peca !== false) {
					$retorno = null;
						
					foreach ($categorias_pativeis as $pativel) {
						$pativel->set_peca_id($id_peca);
						
						if (DAO_Categoria_Pativel::Inserir($pativel) === false) {
							$retorno = false;
						}
					}
					
					foreach ($marcas_pativeis as $pativel) {
						$pativel->set_peca_id($id_peca);
						
						if (DAO_Marca_Pativel::Inserir($pativel) === false) {
							$retorno = false;
						}
					}
					
					foreach ($modelos_pativeis as $pativel) {
						$pativel->set_peca_id($id_peca);
						
						if (DAO_Modelo_Pativel::Inserir($pativel) === false) {
							$retorno = false;
						}
					}
					
					foreach ($versoes_pativeis as $pativel) {
						$pativel->set_peca_id($id_peca);
						
						if (DAO_Versao_Pativel::Inserir($pativel) === false) {
							$retorno = false;
						}
					}
					
					if ($retorno === false) {
						$cadastrar_erros[] = "Erro ao tentar adicionar a Lista Compativel para a Peça";
						$cadastrar_campos['erro_peca'] = "";
					}
					
					if (!empty($_SESSION['imagens_tmp'])) {
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
								
								if (DAO_Foto_Peca::Inserir($foto_peca) === false) {
									$cadastrar_erros[] = "Erro ao tentar adicionar Foto $indice para a Peça";
									$cadastrar_campos['erro_peca'] = "";
								}
							}
						}
					}
				} else {
					$cadastrar_erros[] = "Erro ao tentar Cadastrar Peça";
					$cadastrar_campos['erro_peca'] = "";
				}
			}
			
			if (empty($cadastrar_erros)) {
				$cadastrar_sucesso[] = "Peça Cadastrada Com Sucesso";
				$cadastrar_campos['erro_peca'] = "";
				
				$this->Carregar_Pagina($cadastrar_erros, $cadastrar_campos, null, $cadastrar_sucesso);
			} else {
				$cadastrar_form = array();
					
				$cadastrar_form['peca'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['peca'])))));
				$cadastrar_form['fabricante'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($_POST['fabricante'])))));
				$cadastrar_form['serie'] = trim(strip_tags($_POST['serie']));
				$cadastrar_form['preco'] = trim(strip_tags($_POST['preco']));
				$cadastrar_form['status'] = trim(strip_tags($_POST['status']));
				$cadastrar_form['descricao'] = ucfirst(preg_replace('/\s+/', " ", trim(strip_tags($_POST['descricao']))));
				
				if (isset($_POST['prioridade'])) { 
					$cadastrar_form['prioridade'] = true;
				}
				
				$marcas = null;
				$modelos = null;
				$versoes = null;
				$anos = array();
					
				if (!empty($_SESSION['compatibilidade']['marca'])) {
					$marcas = $_SESSION['compatibilidade']['marca'];
				}
				if (!empty($_SESSION['compatibilidade']['modelo'])) {
					$modelos = $_SESSION['compatibilidade']['modelo'];
				}
				if (!empty($_SESSION['compatibilidade']['versao'])) {
					$versoes = $_SESSION['compatibilidade']['versao'];
				}
					
				if (!empty($marcas)) {
					foreach ($marcas as $marca) {
						if (!empty($_POST['ano_ma_'.$marca.'_de'])) {
							$anos['ano_ma_'.$marca.'_de'] = $_POST['ano_ma_'.$marca.'_de'];
						}
				
						if (!empty($_POST['ano_ma_'.$marca.'_ate'])) {
							$anos['ano_ma_'.$marca.'_ate'] = $_POST['ano_ma_'.$marca.'_ate'];
						}
					}
				}
					
				if (!empty($modelos)) {
					foreach ($modelos as $modelo) {
						if (!empty($_POST['ano_mo_'.$modelo.'_de'])) {
							$anos['ano_mo_'.$modelo.'_de'] = $_POST['ano_mo_'.$modelo.'_de'];
						}
							
						if (!empty($_POST['ano_mo_'.$modelo.'_ate'])) {
							$anos['ano_mo_'.$modelo.'_ate'] = $_POST['ano_mo_'.$modelo.'_ate'];
						}
					}
				}
					
				if (!empty($versoes)) {
					foreach ($versoes as $versao) {
						if (!empty($_POST['ano_vs_'.$versao.'_de'])) {
							$anos['ano_vs_'.$versao.'_de'] = $_POST['ano_vs_'.$versao.'_de'];
						}
				
						if (!empty($_POST['ano_vs_'.$versao.'_ate'])) {
							$anos['ano_vs_'.$versao.'_ate'] = $_POST['ano_vs_'.$versao.'_ate'];
						}
					}
				}
					
				$_SESSION['compatibilidade']['ano'] = $anos;
				
				$this->Carregar_Pagina($cadastrar_erros, $cadastrar_campos, $cadastrar_form, $cadastrar_sucesso);
			}
		}
		
		public function Salvar_Imagem_TMP() {
			if (Controller_Usuario::Verificar_Autenticacao()) {
				$arquivo = null;
				
				if (isset($_FILES['imagem1']) AND $_FILES['imagem1']['error'] === 0) {
					$arquivo = $_FILES['imagem1'];
				} else if (isset($_FILES['imagem2']) AND $_FILES['imagem2']['error'] === 0) {
					$arquivo = $_FILES['imagem2'];
				} else if (isset($_FILES['imagem3']) AND $_FILES['imagem3']['error'] === 0) {
					$arquivo = $_FILES['imagem3'];
				}
				
				if (!empty($arquivo)) {
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
				} else {
					echo "/application/view/resources/img/imagem_indisponivel.png";
				}
			}
		}
		
		public function Deletar_Imagem($num_img) {
			if (Controller_Usuario::Verificar_Autenticacao()) {
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
		}

		public static function Pegar_Imagem_URL($nome_imagem) {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-400x300");
			
			if (isset($caminho_imagem)) {
				return $imagens::Gerar_Data_URL($caminho_imagem);
			} else {
				return "/application/view/resources/img/imagem_indisponivel.png";
			}
		}
		
		public static function Buscar_Categorias() {
			return DAO_Categoria::BuscarTodos();
		}
		
		public static function Buscar_Id_Marcas_Por_Id_Categoria($id_categoria) {
			return DAO_Marca::Buscar_Id_Por_Id_Categorai($id_categoria);
		}
		
		public static function Buscar_Id_Modelos_Por_Id_Marca($id_marca) {
			return DAO_Modelo::Buscar_Id_Por_Id_Marca($id_marca);
		}
		
		public static function Buscar_Id_Versoes_Por_Id_Modelo($id_modelo) {
			return DAO_Versao::Buscar_Id_Por_Id_Modelo($id_modelo);
		}
		
		public static function Buscar_Marcas_Por_Categoria($id_categoria) {
			return DAO_Marca::Buscar_Por_Id_Categorai($id_categoria);
		}
		
		public static function Buscar_Modelos_Por_Marca($id_marca) {
			return DAO_Modelo::Buscar_Por_Id_Marca($id_marca);
		}
		
		public static function Buscar_Versoes_Por_Modelo($id_modelo) {
			return DAO_Versao::Buscar_Por_Id_Modelo($id_modelo);
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