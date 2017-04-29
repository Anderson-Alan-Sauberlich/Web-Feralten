<?php
namespace application\controller\usuario\meu_perfil\pecas;
	
	require_once RAIZ.'/application/model/common/util/login_session.php';
	require_once RAIZ.'/application/model/common/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/model/object/peca.php';
	require_once RAIZ.'/application/model/object/endereco.php';
	require_once RAIZ.'/application/model/object/status_peca.php';
	require_once RAIZ.'/application/model/object/categoria_pativel.php';
	require_once RAIZ.'/application/model/object/marca_pativel.php';
	require_once RAIZ.'/application/model/object/modelo_pativel.php';
	require_once RAIZ.'/application/model/object/versao_pativel.php';
	require_once RAIZ.'/application/model/object/foto_peca.php';
	require_once RAIZ.'/application/model/object/entidade.php';
	require_once RAIZ.'/application/model/object/usuario.php';
	require_once RAIZ.'/application/model/dao/preferencia_entrega.php';
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
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/pecas/cadastrar.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	
	use application\model\common\util\Login_Session;
	use application\model\common\util\Gerenciar_Imagens;
	use application\model\object\Peca as Object_Peca;
	use application\model\object\Endereco as Object_Endereco;
	use application\model\object\Status_Peca as Object_Status_Peca;
	use application\model\object\Categoria_Pativel as Object_Categoria_Pativel;
	use application\model\object\Marca_Pativel as Object_Marca_Pativel;
	use application\model\object\Modelo_Pativel as Object_Modelo_Pativel;
	use application\model\object\Versao_Pativel as Object_Versao_Pativel;
	use application\model\object\Foto_Peca as Object_Foto_Peca;
	use application\model\object\Entidade as Object_Entidade;
	use application\model\object\Usuario as Object_Usuario;
	use application\model\dao\Preferencia_Entrega as DAO_Preferencia_Entrega;
    use application\model\dao\Categoria as DAO_Categoria;
    use application\model\dao\Marca as DAO_Marca;
    use application\model\dao\Modelo as DAO_Modelo;
    use application\model\dao\Versao as DAO_Versao;
    use application\model\dao\Categoria_Compativel as DAO_Categoria_Compativel;
    use application\model\dao\Marca_Compativel as DAO_Marca_Compativel;
    use application\model\dao\Modelo_Compativel as DAO_Modelo_Compativel;
    use application\model\dao\Versao_Compativel as DAO_Versao_Compativel;
	use application\model\dao\Status_Peca as DAO_Status_Peca;
	use application\model\dao\Categoria_Pativel as DAO_Categoria_Pativel;
	use application\model\dao\Marca_Pativel as DAO_Marca_Pativel;
	use application\model\dao\Modelo_Pativel as DAO_Modelo_Pativel;
	use application\model\dao\Versao_Pativel as DAO_Versao_Pativel;
	use application\model\dao\Peca as DAO_Peca;
	use application\model\dao\Endereco as DAO_Endereco;
	use application\model\dao\Foto_Peca as DAO_Foto_Peca;
	use application\view\src\usuario\meu_perfil\pecas\Cadastrar as View_Cadastrar;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
		
    class Cadastrar {

        function __construct() {
            
        }
        
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $descricao;
        private $status;
        private $preferencia_entrega;
        private $fabricante;
        private $peca;
        private $serie;
        private $preco;
        private $prioridade;
        
        public function set_categoria($categoria) {
        	$this->categoria = $categoria;
        }
        
        public function set_marca($marca) {
        	$this->marca = $marca;
        }
        
        public function set_modelo($modelo) {
        	$this->modelo = $modelo;
        }
        
        public function set_versao($versao) {
        	$this->versao = $versao;
        }
        
        public function set_descricao($descricao) {
        	$this->descricao = $descricao;
        }
        
        public function set_status($status) {
        	$this->status = $status;
        }
        
        public function set_preferencia_entrega($preferencia_entrega) {
        	$this->preferencia_entrega = $preferencia_entrega;
        }
        
        public function set_fabricante($fabricante) {
        	$this->fabricante = $fabricante;
        }
        
        public function set_peca($peca) {
        	$this->peca = $peca;
        }
        
        public function set_serie($serie) {
        	$this->serie = $serie;
        }
        
        public function set_preco($preco) {
        	$this->preco = $preco;
        }
        
        public function set_prioridade($prioridade) {
        	$this->prioridade = $prioridade;
        }
        
        public function Carregar_Pagina(?array $cadastrar_erros = null, ?array $cadastrar_campos = null, ?array $cadastrar_form = null, ?array $cadastrar_sucesso = null) {
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
        
        public function Carregar_Compatibilidade() : void {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
	        	if (!empty($this->categoria)) {
	        		if ($this->categoria == "verificar") {
	        			View_Cadastrar::Carregar_Marcas();
	        		} else {
	        			$this->Salvar_Session_Compatibilidade();
	        			View_Cadastrar::Carregar_Categorias();
	        		}
	        	}
	        		
	        	if (!empty($this->marca)) {
	        		if ($this->marca == "verificar") {
	        			View_Cadastrar::Carregar_Modelos();
	        		} else {
	        			$this->Salvar_Session_Compatibilidade();
	        			View_Cadastrar::Carregar_Marcas();
	        		}
	        	}
	        		
	        	if (!empty($this->modelo)) {
	        		if ($this->modelo == "verificar") {
	        			View_Cadastrar::Carregar_Versoes();
	        		} else {
	        			$this->Salvar_Session_Compatibilidade();
	        			View_Cadastrar::Carregar_Modelos();
	        		}
	        	}
	        		
	        	if (!empty($this->versao)) {
	        		if ($this->versao == "verificar") {
	        			View_Cadastrar::Carregar_Anos();
	        		} else {
	        			$this->Salvar_Session_Compatibilidade();
	        			View_Cadastrar::Carregar_Versoes();
	        		}
	        	}
        	}
        }
        
        private function Salvar_Session_Compatibilidade() : void {
        	$compatibilidade = array();
        		
        	$compatibilidade['categoria'] = array();
        	$compatibilidade['marca'] = array();
        	$compatibilidade['modelo'] = array();
        	$compatibilidade['versao'] = array();
        	$compatibilidade['ano'] = array();
        		
        	if (isset($_SESSION['compatibilidade'])) {
        		$compatibilidade = $_SESSION['compatibilidade'];
        	}
        		
        	if (!empty($this->categoria)) {
        		if (isset($compatibilidade['categoria'])) {
        			if (isset($compatibilidade['categoria'][$this->categoria])) {
        				unset($compatibilidade['categoria'][$this->categoria]);
        
        				if (isset($compatibilidade['marca'])) {
        					$id_marcas = self::Buscar_Id_Marcas_Por_Id_Categoria($this->categoria);
        						
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
        				$compatibilidade['categoria'][$this->categoria] = $this->categoria;
        			}
        		} else {
        			$compatibilidade['categoria'][$this->categoria] = $this->categoria;
        		}
        	}
        		
        	if (!empty($this->marca)) {
        		if (isset($compatibilidade['marca'])) {
        			if (isset($compatibilidade['marca'][$this->marca])) {
        				unset($compatibilidade['marca'][$this->marca]);
        
        				if (isset($compatibilidade['modelo'])) {
        					$id_modelos = self::Buscar_Id_Modelos_Por_Id_Marca($this->marca);
        						
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
        				$compatibilidade['marca'][$this->marca] = $this->marca;
        			}
        		} else {
        			$compatibilidade['marca'][$this->marca] = $this->marca;
        		}
        	}
        		
        	if (!empty($this->modelo)) {
        		if (isset($compatibilidade['modelo'])) {
        			if (isset($compatibilidade['modelo'][$this->modelo])) {
        				unset($compatibilidade['modelo'][$this->modelo]);
        
        				if (isset($compatibilidade['versao'])) {
        					$id_versoes = self::Buscar_Id_Versoes_Por_Id_Modelo($this->modelo);
        						
        					foreach ($id_versoes as $id_versao) {
        						if (isset($compatibilidade['versao'][$id_versao])) {
        							unset($compatibilidade['versao'][$id_versao]);
        						}
        					}
        				}
        			} else {
        				$compatibilidade['modelo'][$this->modelo] = $this->modelo;
        			}
        		} else {
        			$compatibilidade['modelo'][$this->modelo] = $this->modelo;
        		}
        	}
        		
        	if (!empty($this->versao)) {
        		if (isset($compatibilidade['versao'])) {
        			if (isset($compatibilidade['versao'][$this->versao])) {
        				unset($compatibilidade['versao'][$this->versao]);
        			} else {
        				$compatibilidade['versao'][$this->versao] = $this->versao;
        			}
        		} else {
        			$compatibilidade['versao'][$this->versao] = $this->versao;
        		}
        	}
        		
        	$_SESSION['compatibilidade'] = $compatibilidade;
        }
		
		private function Cadastrar_Peca() : void {
			$cadastrar_erros = array();
			$cadastrar_sucesso = array();
			$cadastrar_campos = array('erro_peca' => "certo");
			
			$object_peca = new Object_Peca();
			$object_status = new Object_Status_Peca();
			
			$object_peca->set_status($object_status);
			
			if (!empty($this->descricao)) {
				$descricao = strip_tags($this->descricao);
				 
				if ($descricao === $this->descricao) {
					$this->descricao = trim($this->descricao);
					$this->descricao = preg_replace('/\s+/', " ", $this->descricao);
					 
					if (strlen($this->descricao) <= 1000) {
						$object_peca->set_descricao(ucfirst($this->descricao));
					} else {
						$erros_concluir[] = "Descricao, Não pode conter mais de 1000 Caracteres";
						$cnclr_campos['erro_descricao'] = "erro";
					}
				} else {
					$cadastrar_erros[] = "Descricao, Não pode conter Tags de Programação";
					$cadastrar_campos['erro_descricao'] = "erro";
				}
			}
			
			if (!empty($this->status)) {
				if (filter_var($this->status, FILTER_VALIDATE_INT)) {
					$object_status->set_id($this->status);
					
					$object_peca->set_status($object_status);
				} else {
					$cadastrar_erros[] = "Status, Selecione um Status Valido.";
					$cadastrar_campos['erro_status'] = "erro";
				}
			}
			
			if (!empty($this->preferencia_entrega)) {
				$valor = 0;
				
				if (is_array($this->preferencia_entrega)) {
					foreach ($this->preferencia_entrega as $preferencia_entrega) {
						if (filter_var($preferencia_entrega, FILTER_VALIDATE_INT)) {
							$valor += $preferencia_entrega;
						}
					}
					
					if (!empty($valor) AND filter_var($valor, FILTER_VALIDATE_INT)) {
						$object_peca->set_preferencia_entrega($valor);
					}
				}
			}
			
			if (!empty($this->fabricante)) {
				$fabricante = strip_tags($this->fabricante);
				
				if ($fabricante === $this->fabricante) {
					$this->fabricante = trim($this->fabricante);
					$this->fabricante = preg_replace('/\s+/', " ", $this->fabricante);
					 
					if (strlen($this->fabricante) <= 50) {
						$object_peca->set_fabricante(ucwords(strtolower($this->fabricante)));
					} else {
						$cadastrar_erros[] = "Fabricante, Não pode conter mais de 50 Caracteres";
						$cadastrar_campos['erro_fabricante'] = "erro";
					}
				} else {
					$cadastrar_erros[] = "Fabricante, Não pode conter Tags de Programação";
					$cadastrar_campos['erro_fabricante'] = "erro";
				}
			}
			
			if (!empty($this->peca)) {
				$peca = strip_tags($this->peca);
				
				if ($peca === $this->peca) {
					$this->peca = trim($this->peca);
					$this->peca = preg_replace('/\s+/', " ", $this->peca);
				
					if (strlen($this->peca) <= 50) {
						$object_peca->set_nome(ucwords(strtolower($this->peca)));
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
			
			if (!empty($this->serie)) {
				$serie = strip_tags($this->serie);
				
				if ($serie === $this->serie) {
					$this->serie = trim($this->serie);
					$this->serie = preg_replace('/\s+/', " ", $this->serie);
				
					if (strlen($this->serie) <= 150) {
						$object_peca->set_serie($this->serie);
					} else {
						$cadastrar_erros[] = "Numero de Serie, Não pode conter mais de 150 Caracteres";
						$cadastrar_campos['erro_serie'] = "erro";
					}
				} else {
					$cadastrar_erros[] = "Numero de Serie, Não pode conter Tags de Programação";
					$cadastrar_campos['erro_serie'] = "erro";
				}
			}
			
			if (!empty($this->preco)) {
				if (filter_var($this->preco, FILTER_VALIDATE_FLOAT)) {
					$object_peca->set_preco($this->preco);
				} else {
					$cadastrar_erros[] = "Digite um Preço Valido para a peça";
					$cadastrar_campos['erro_preco'] = "erro";
				}
			}
			
			if (!empty($this->prioridade)) {
				$object_peca->set_prioridade(true);
			}
				
			$categorias_compativeis = null;
			$marcas_compativeis = null;
			$modelos_compativeis = null;
			$versoes_compativeis = null;
			
			$categorias_pativeis = array();
			$marcas_pativeis = array();
			$modelos_pativeis = array();
			$versoes_pativeis = array();
				
			if (!empty($this->categoria)) {
				$categorias_compativeis = self::Buscar_Categorias_Compativeis(current($this->categoria));
			
				if (!empty($this->marca)) {
					$marcas_compativeis = self::Buscar_Marcas_Compativeis(current($this->marca));
						
					if (!empty($this->modelo)) {
						$modelos_compativeis = self::Buscar_Modelos_Compativeis(current($this->modelo));
			
						if (!empty($this->versao)) {
							$versoes_compativeis = self::Buscar_Versoes_Compativeis(current($this->versao));
						}
					}
				}
			}
				
			if (!empty($this->categoria)) {
				foreach ($this->categoria as $categoria_selecionada) {
					if (in_array($categoria_selecionada, $categorias_compativeis)) {
						$categoria_pativel = new Object_Categoria_Pativel();
						$categoria_pativel->set_categoria_id($categoria_selecionada);
						
						$categorias_pativeis[] = $categoria_pativel;
						
						if (!empty($this->marca)) {
							foreach ($this->marca as $marca_selecionada) {
								if (in_array($marca_selecionada, $marcas_compativeis)) {
									if (self::Buscar_Categoria_Id_Por_Marca($marca_selecionada) == $categoria_selecionada) {
										$marca_pativel = new Object_Marca_Pativel();
										$marca_pativel->set_marca_id($marca_selecionada);
										
										if (!empty($_POST['ano_mrc_'.$marca_selecionada])) {
											$marca_pativel->set_anos($_POST['ano_mrc_'.$marca_selecionada]);
										}
										
										$marcas_pativeis[] = $marca_pativel;
										
										if (!empty($this->modelo)) {
											foreach ($this->modelo as $modelo_selecionado) {
												if (in_array($modelo_selecionado, $modelos_compativeis)) {
													if (self::Buscar_Marca_Id_Por_Modelo($modelo_selecionado) == $marca_selecionada) {
														$modelo_pativel = new Object_Modelo_Pativel();
														$modelo_pativel->set_modelo_id($modelo_selecionado);
														
														if (!empty($_POST['ano_mdl_'.$modelo_selecionado])) {
															$modelo_pativel->set_anos($_POST['ano_mdl_'.$modelo_selecionado]);
														}
														
														$modelos_pativeis[] = $modelo_pativel;
														
														if (!empty($this->versao)) {
															foreach ($this->versao as $versao_selecionada) {
																if (in_array($versao_selecionada, $versoes_compativeis)) {
																	if (self::Buscar_Modelo_Id_Por_Versao($versao_selecionada) == $modelo_selecionado) {
																		$versao_pativel = new Object_Versao_Pativel();
																		$versao_pativel->set_versao_id($versao_selecionada);
			
																		if (!empty($_POST['ano_vrs_'.$versao_selecionada])) {
																			$versao_pativel->set_anos($_POST['ano_vrs_'.$versao_selecionada]);
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
				$entidade = new Object_Entidade();
				
				$entidade->set_id(Login_Session::get_entidade_id());
				$entidade->set_usuario_id(Login_Session::get_usuario_id());
				
				$object_peca->set_entidade($entidade);
				$object_peca->set_data_anuncio(date('Y-m-d H:i:s'));
				
				$id_endereco = DAO_Endereco::Buscar_Id_Por_Id_Entidade(Login_Session::get_entidade_id());
				
				if ($id_endereco === false) {
					$cadastrar_erros[] = "Erro ao tentar adicionar o Endereço do Usuario para a Peça";
					$cadastrar_campos['erro_peca'] = "";
				} else {
					$endereco = new Object_Endereco();
					
					$endereco->set_id($id_endereco);
					
					$object_peca->set_id(0);
					$object_peca->set_endereco($endereco);
					
					$usuario_responsavel = new Object_Usuario();
					
					$usuario_responsavel->set_id(Login_Session::get_usuario_id());
					
					$object_peca->set_responsavel($usuario_responsavel);
				}
				
				$id_peca = DAO_Peca::Inserir($object_peca);
				
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
				
				$cadastrar_form['peca'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($this->peca)))));
				$cadastrar_form['fabricante'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($this->fabricante)))));
				$cadastrar_form['serie'] = trim(strip_tags($this->serie));
				$cadastrar_form['preco'] = trim(strip_tags($this->preco));
				$cadastrar_form['status'] = trim(strip_tags($this->status));
				$cadastrar_form['descricao'] = ucfirst(preg_replace('/\s+/', " ", trim(strip_tags($this->descricao))));
				
				if (!empty($this->prioridade)) { 
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
						if (!empty($_POST['ano_mrc_'.$marca])) {
							$anos['ano_mrc_'.$marca] = $_POST['ano_mrc_'.$marca];
						}
					}
				}
				
				if (!empty($modelos)) {
					foreach ($modelos as $modelo) {
						if (!empty($_POST['ano_mdl_'.$modelo])) {
							$anos['ano_mdl_'.$modelo] = $_POST['ano_mdl_'.$modelo];
						}
					}
				}
				
				if (!empty($versoes)) {
					foreach ($versoes as $versao) {
						if (!empty($_POST['ano_vrs_'.$versao])) {
							$anos['ano_vrs_'.$versao] = $_POST['ano_vrs_'.$versao];
						}
					}
				}
					
				$_SESSION['compatibilidade']['ano'] = $anos;
				
				$this->Carregar_Pagina($cadastrar_erros, $cadastrar_campos, $cadastrar_form, $cadastrar_sucesso);
			}
		}
		
		public function Salvar_Imagem_TMP() : void {
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
		
		public function Deletar_Imagem(int $num_img) : void {
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

		public static function Pegar_Imagem_URL(string $nome_imagem) : string {
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
		
		public static function Buscar_Id_Marcas_Por_Id_Categoria(int $id_categoria) {
			return DAO_Marca::Buscar_Id_Por_Id_Categorai($id_categoria);
		}
		
		public static function Buscar_Id_Modelos_Por_Id_Marca(int $id_marca) {
			return DAO_Modelo::Buscar_Id_Por_Id_Marca($id_marca);
		}
		
		public static function Buscar_Id_Versoes_Por_Id_Modelo(int $id_modelo) {
			return DAO_Versao::Buscar_Id_Por_Id_Modelo($id_modelo);
		}
		
		public static function Buscar_Marcas_Por_Categoria(int $id_categoria) {
			return DAO_Marca::Buscar_Por_Id_Categorai($id_categoria);
		}
		
		public static function Buscar_Modelos_Por_Marca(int $id_marca) {
			return DAO_Modelo::Buscar_Por_Id_Marca($id_marca);
		}
		
		public static function Buscar_Versoes_Por_Modelo(int $id_modelo) {
			return DAO_Versao::Buscar_Por_Id_Modelo($id_modelo);
		}
		
		public static function Buscar_Categoria_Por_Id(int $id_categoria) {
			return DAO_Categoria::BuscarPorCOD($id_categoria);
		}
		
		public static function Buscar_Marca_Por_Id(int $id_marca) {
			return DAO_Marca::BuscarPorCOD($id_marca);
		}
		
		public static function Buscar_Modelo_Por_Id(int $id_modelo) {
			return DAO_Modelo::BuscarPorCOD($id_modelo);
		}
		
		public static function Buscar_Versao_Por_Id(int $id_versao) {
			return DAO_Versao::BuscarPorCOD($id_versao);
		}
		
		public static function Buscar_Status_Pecas() {
			return DAO_Status_Peca::BuscarTodos();
		}
		
		public static function Buscar_Categoria_Id_Por_Marca(int $id_marca) {
			return DAO_Marca::Buscar_Categoria_Id($id_marca);
		}
		
		public static function Buscar_Marca_Id_Por_Modelo(int $id_modelo) {
			return DAO_Modelo::Buscar_Marca_Id($id_modelo);
		}
		
		public static function Buscar_Modelo_Id_Por_Versao(int $id_versao) {
			return DAO_Versao::Buscar_Modelo_Id($id_versao);
		}
		
		public static function Buscar_Categorias_Compativeis(int $id_categoria) {
			return DAO_Categoria_Compativel::BuscarPorCOD($id_categoria);
		}
		
		public static function Buscar_Marcas_Compativeis(int $id_marca) {
			return DAO_Marca_Compativel::BuscarPorCOD($id_marca);
		}
		
		public static function Buscar_Modelos_Compativeis(int $id_modelo) {
			return DAO_Modelo_Compativel::BuscarPorCOD($id_modelo);
		}
		
		public static function Buscar_Versoes_Compativeis(int $id_versao) {
			return DAO_Versao_Compativel::BuscarPorCOD($id_versao);
		}
		
		public static function Buscar_Preferencia_Entrega() {
			return DAO_Preferencia_Entrega::Buscar_Todos_Masivos();
		}
    }
?>