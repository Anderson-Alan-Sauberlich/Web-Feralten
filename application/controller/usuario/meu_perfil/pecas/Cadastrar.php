<?php
namespace application\controller\usuario\meu_perfil\pecas;
	
	use application\model\common\util\Validador;
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
	use \Exception;
	
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
        private $imagens = array();
        private $cadastrar_erros = array();
        private $cadastrar_sucesso = array();
        private $cadastrar_campos = array();
        private $cadastrar_form = array();
        
        public function set_categoria($categoria) {
        	try {
        		//$this->categoria = Validador::Categoria()::validar_id($categoria);
        		$this->categoria = $categoria;
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		
        		$this->categoria = Validador::Categoria()::filtrar_id($categoria);
        	}
        }
        
        public function set_marca($marca) {
        	try {
        		//$this->marca = Validador::Marca()::validar_id($marca);
        		$this->marca = $marca;
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		
        		$this->marca = Validador::Marca()::filtrar_id($marca);
        	}
        }
        
        public function set_modelo($modelo) {
        	try {
        		//$this->modelo = Validador::Modelo()::validar_id($modelo);
        		$this->modelo = $modelo;
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		
        		$this->modelo = Validador::Modelo()::filtrar_id($modelo);
        	}
        }
        
        public function set_versao($versao) {
        	try {
        		//$this->versao = Validador::Versao()::validar_id($versao);
        		$this->versao = $versao;
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		
        		$this->versao = Validador::Versao()::filtrar_id($versao);
        	}
        }
        
        public function set_descricao($descricao) {
        	try {
        		$this->descricao = Validador::Peca()::validar_descricao($descricao);
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		$this->cadastrar_campos['erro_descricao'] = 'erro';
        		
        		$this->descricao = Validador::Peca()::filtrar_descricao($descricao);
        	}
        }
        
        public function set_status($status) {
        	try {
        		$this->status = Validador::Peca()::validar_status($status);
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		$this->cadastrar_campos['erro_status'] = 'erro';
        		
        		$this->status = Validador::Peca()::filtrar_status($status);
        	}
        }
        
        public function set_preferencia_entrega($preferencia_entrega) {
        	try {
        		$this->preferencia_entrega = Validador::Peca()::validar_preferencia_entrega($preferencia_entrega);
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		
        		$this->preferencia_entrega = Validador::Peca()::filtrar_preferencia_entrega($preferencia_entrega);
        	}
        }
        
        public function set_fabricante($fabricante) {
        	try {
        		$this->fabricante = Validador::Peca()::validar_fabricante($fabricante);
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		$this->cadastrar_campos['erro_fabricante'] = 'erro';
        		
        		$this->fabricante = Validador::Peca()::filtrar_fabricante($fabricante);
        	}
        }
        
        public function set_peca($peca) {
        	try {
        		$this->peca = Validador::Peca()::validar_nome($peca);
        		$this->cadastrar_campos['erro_peca'] = 'certo';
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		$this->cadastrar_campos['erro_peca'] = 'erro';
        		
        		$this->peca = Validador::Peca()::filtrar_nome($peca);
        	}
        }
        
        public function set_serie($serie) {
        	try {
        		$this->serie = Validador::Peca()::validar_serie($serie);
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		$this->cadastrar_campos['erro_serie'] = 'erro';
        		
        		$this->serie = Validador::Peca()::filtrar_serie($serie);
        	}
        }
        
        public function set_preco($preco) {
        	try {
        		$this->preco = Validador::Peca()::validar_preco($preco);
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		$this->cadastrar_campos['erro_preco'] = 'erro';
        		
        		$this->preco = Validador::Peca()::filtrar_preco($preco);
        	}
        }
        
        public function set_prioridade($prioridade) {
        	try {
        		$this->prioridade = Validador::Peca()::validar_prioridade($prioridade);
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        		
        		$this->prioridade = Validador::Peca()::filtrar_prioridade($prioridade);
        	}
        }
        
        public function set_imagem($imagem, $numero) {
        	try {
        		$this->imagens[$numero] = Validador::Foto_Peca()::validar_imagem($imagem, $numero);
        	} catch (Exception $e) {
        		$this->cadastrar_erros[] = $e->getMessage();
        	}
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			if (empty($this->cadastrar_form)) {
        				unset($_SESSION['compatibilidade']);
        				$this->Deletar_Imagem(123);
        			}
        			
        			$view = new View_Cadastrar($status);
        			
        			$view->set_cadastrar_campos($this->cadastrar_campos);
        			$view->set_cadastrar_erros($this->cadastrar_erros);
        			$view->set_cadastrar_form($this->cadastrar_form);
        			$view->set_cadastrar_sucesso($this->cadastrar_sucesso);
        			 
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
										
										if (isset($_POST['ano_mrc_'.$marca_selecionada]) AND !empty($_POST['ano_mrc_'.$marca_selecionada])) {
											$marca_pativel->set_anos($_POST['ano_mrc_'.$marca_selecionada]);
										}
										
										$marcas_pativeis[] = $marca_pativel;
										
										if (!empty($this->modelo)) {
											foreach ($this->modelo as $modelo_selecionado) {
												if (in_array($modelo_selecionado, $modelos_compativeis)) {
													if (self::Buscar_Marca_Id_Por_Modelo($modelo_selecionado) == $marca_selecionada) {
														$modelo_pativel = new Object_Modelo_Pativel();
														$modelo_pativel->set_modelo_id($modelo_selecionado);
														
														if (isset($_POST['ano_mdl_'.$modelo_selecionado]) AND !empty($_POST['ano_mdl_'.$modelo_selecionado])) {
															$modelo_pativel->set_anos($_POST['ano_mdl_'.$modelo_selecionado]);
														}
														
														$modelos_pativeis[] = $modelo_pativel;
														
														if (!empty($this->versao)) {
															foreach ($this->versao as $versao_selecionada) {
																if (in_array($versao_selecionada, $versoes_compativeis)) {
																	if (self::Buscar_Modelo_Id_Por_Versao($versao_selecionada) == $modelo_selecionado) {
																		$versao_pativel = new Object_Versao_Pativel();
																		$versao_pativel->set_versao_id($versao_selecionada);
			
																		if (isset($_POST['ano_vrs_'.$versao_selecionada]) AND !empty($_POST['ano_vrs_'.$versao_selecionada])) {
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
			
			if (empty($this->cadastrar_erros)) {
				$object_peca = new Object_Peca();
				$object_status = new Object_Status_Peca();
				$entidade = new Object_Entidade();
				
				if ($this->status > 0) {
					$object_status->set_id($this->status);
				}
				
				$object_peca->set_status($object_status);
				$object_peca->set_descricao($this->descricao);
				$object_peca->set_preferencia_entrega($this->preferencia_entrega);
				$object_peca->set_fabricante($this->fabricante);
				$object_peca->set_nome($this->peca);
				$object_peca->set_serie($this->serie);
				$object_peca->set_preco($this->preco);
				$object_peca->set_prioridade($this->prioridade);
				
				$entidade->set_id(Login_Session::get_entidade_id());
				$entidade->set_usuario_id(Login_Session::get_usuario_id());
				
				$object_peca->set_entidade($entidade);
				$object_peca->set_data_anuncio(date('Y-m-d H:i:s'));
				
				$id_endereco = DAO_Endereco::Buscar_Id_Por_Id_Entidade(Login_Session::get_entidade_id());
				
				if ($id_endereco === false) {
					$this->cadastrar_erros[] = "Erro ao tentar adicionar o Endereço do Usuario para a Peça";
					$this->cadastrar_campos['erro_peca'] = "";
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
						$this->cadastrar_erros[] = "Erro ao tentar adicionar a Lista Compativel para a Peça";
						$this->cadastrar_campos['erro_peca'] = "";
					}
					
					if (isset($_SESSION['imagens_tmp']) AND !empty($_SESSION['imagens_tmp'])) {
						$imagens = new Gerenciar_Imagens();
						$img_descricao = Validador::Foto_Peca()::filtrar_descricao_nome($this->peca);
						
						$diretorios_imagens = $imagens->Arquivar_Imagem_Peca($_SESSION['imagens_tmp'], $id_peca, $img_descricao);
						
						if (!empty($diretorios_imagens)) {
							foreach ($diretorios_imagens as $key => $diretorio) {
								$foto_peca = new Object_Foto_Peca();
								
								$foto_peca->set_peca_id($id_peca);
								$foto_peca->set_endereco($diretorio);
								$foto_peca->set_numero($key);
								$foto_peca->set_nome(str_replace('img_tmp_', 'img_'.$img_descricao.'_', $_SESSION['imagens_tmp'][$key]));
								
								if (DAO_Foto_Peca::Inserir($foto_peca) === false) {
									$this->cadastrar_erros[] = "Erro ao tentar adicionar Foto $key para a Peça";
									$this->cadastrar_campos['erro_peca'] = "";
								}
							}
							
							unset($_SESSION['imagens_tmp']);
						} else {
							$this->atualizar_erros[] = "Erro ao tentar Cadastrar Fotos da Peça";
							$this->atualizar_campos['erro_peca'] = "";
						}
					}
				} else {
					$this->cadastrar_erros[] = "Erro ao tentar Cadastrar Peça";
					$this->cadastrar_campos['erro_peca'] = "";
				}
			}
			
			if (empty($this->cadastrar_erros)) {
				$this->cadastrar_sucesso[] = "Peça Cadastrada Com Sucesso";
				$this->cadastrar_campos['erro_peca'] = "";
				
				$this->Carregar_Pagina();
			} else {
				$this->cadastrar_form['peca'] = $this->peca;
				$this->cadastrar_form['fabricante'] = $this->fabricante;
				$this->cadastrar_form['serie'] = $this->serie;
				$this->cadastrar_form['preco'] = $this->preco;
				$this->cadastrar_form['status'] = $this->status;
				$this->cadastrar_form['descricao'] = $this->descricao;
				$this->cadastrar_form['prioridade'] = $this->prioridade;
				$this->cadastrar_form['preferencia_entrega'] = Object_Peca::get_preferencias_entrega($this->preferencia_entrega);
				
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
				
				$this->Carregar_Pagina();
			}
		}
		
		public function Salvar_Imagem_TMP() : void {
			if (Controller_Usuario::Verificar_Autenticacao()) {
				if (!empty($this->imagens)) {
					$imagens = new Gerenciar_Imagens();
					
					foreach ($this->imagens as $key => $imagem) {
						$imagens->Armazenar_Imagem_Temporaria($imagem);
						
						if (!isset($_SESSION['imagens_tmp'][$key])) {
							$_SESSION['imagens_tmp'][$key] = $imagens->get_nome();
						}
						
						echo Gerenciar_Imagens::Gerar_Data_URL($imagens->get_caminho()."-400x300.".$imagens->get_extensao());
					}
				}  else {
					echo "/application/view/resources/img/imagem_indisponivel.png";
				}
			}
		}
		
		public function Deletar_Imagem(int $num_img) : void {
			if (Controller_Usuario::Verificar_Autenticacao()) {
				if (isset($_SESSION['imagens_tmp'])) {
					if (isset($_SESSION['imagens_tmp'][$num_img]) OR $num_img == 123) {
						$imagens = new Gerenciar_Imagens();
						
						if ($num_img === 123) {
							if (isset($_SESSION['imagens_tmp'][1])) {
								$imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][1]);
							}
							if (isset($_SESSION['imagens_tmp'][2])) {
								$imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][2]);
							}
							if (isset($_SESSION['imagens_tmp'][3])) {
								$imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][3]);
							}
							
							unset($_SESSION['imagens_tmp']);
						} else if ($num_img === 1) {
							$imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][1]);
							
							if (isset($_SESSION['imagens_tmp'][2])) {
								$_SESSION['imagens_tmp'][1] = $_SESSION['imagens_tmp'][2];
								
								if (isset($_SESSION['imagens_tmp'][3])) {
									$_SESSION['imagens_tmp'][2] = $_SESSION['imagens_tmp'][3];
									unset($_SESSION['imagens_tmp'][3]);
								} else {
									unset($_SESSION['imagens_tmp'][2]);
								}
							} else {
								unset($_SESSION['imagens_tmp'][1]);
							}
						} else if ($num_img === 2) {
							$imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][2]);
							
							if (isset($_SESSION['imagens_tmp'][3])) {
								$_SESSION['imagens_tmp'][2] = $_SESSION['imagens_tmp'][3];
								unset($_SESSION['imagens_tmp'][3]);
							} else {
								unset($_SESSION['imagens_tmp'][2]);
							}
						} else if ($num_img === 3) {
							$imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][3]);
							
							unset($_SESSION['imagens_tmp'][3]);
						}
						
						if (isset($_SESSION['imagens_tmp'])) {
							if (empty($_SESSION['imagens_tmp'])) {
								unset($_SESSION['imagens_tmp']);
							}
						}
					}
				}
			}
		}

		public static function Pegar_Imagem_URL(string $nome_imagem) : string {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem_TMP($nome_imagem."-400x300");
			
			if (!empty($caminho_imagem)) {
				return Gerenciar_Imagens::Gerar_Data_URL($caminho_imagem);
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