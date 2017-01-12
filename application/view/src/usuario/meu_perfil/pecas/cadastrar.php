<?php
namespace application\view\src\usuario\meu_perfil\pecas;
	
	require_once RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php';
	require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
	
	use application\controller\usuario\meu_perfil\pecas\Cadastrar as Controller_Cadastrar;
	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
	
    class Cadastrar {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $cadastrar_erros;
        private static $cadastrar_campos;
        private static $cadastrar_form;
        private static $cadastrar_sucesso;
        
        public function set_cadastrar_erros($cadastrar_erros) {
        	self::$cadastrar_erros = $cadastrar_erros;
        }
        
        public function set_cadastrar_campos($cadastrar_campos) {
        	self::$cadastrar_campos = $cadastrar_campos;
        }
        
        public function set_cadastrar_form($cadastrar_form) {
        	self::$cadastrar_form = $cadastrar_form;
        }
        
        public function set_cadastrar_sucesso($cadastrar_sucesso) {
        	self::$cadastrar_sucesso = $cadastrar_sucesso;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/pecas/cadastrar.php';
        }

        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('pecas', 'cadastrar'));
        }
        
		public static function Mostrar_Sucesso() {
            if (!empty(self::$cadastrar_sucesso)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$cadastrar_sucesso as $value) {
                    echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>".$value."</b></div>";
                }
                echo "</div></div>";
            }
		}

		public static function Mostrar_Erros() {
            if (!empty(self::$cadastrar_erros)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$cadastrar_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>".$value."</b></div>";
                }
                echo "</div></div>";
            }
		}
		
		public static function Incluir_Classe_Erros($campo) {
        	if (!empty(self::$cadastrar_campos)) {
	            switch ($campo) {
	                case "peca":
	                	if (isset(self::$cadastrar_campos['erro_peca'])) {
		                    if (self::$cadastrar_campos['erro_peca'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$cadastrar_campos['erro_peca'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "descricao":
	                   	if (isset(self::$cadastrar_campos['erro_descricao'])) {
	                		if (self::$cadastrar_campos['erro_descricao'] == "erro") {
	                			echo "has-error has-feedback";
	                		} else if (self::$cadastrar_campos['erro_descricao'] == "certo") {
	                			echo "has-success has-feedback";
	                		}
	                	}
	                	break;
	                	
	                case "status":
	                	if (isset(self::$cadastrar_campos['erro_status'])) {
	                		if (self::$cadastrar_campos['erro_status'] == "erro") {
	                			echo "has-error has-feedback";
	                		} else if (self::$cadastrar_campos['erro_status'] == "certo") {
	                			echo "has-success has-feedback";
	                		}
	                	}
	                	break;
	                	
	                case "fabricante":
	                	if (isset(self::$cadastrar_campos['erro_fabricante'])) {
	                		if (self::$cadastrar_campos['erro_fabricante'] == "erro") {
	                			echo "has-error has-feedback";
	                		} else if (self::$cadastrar_campos['erro_fabricante'] == "certo") {
	                			echo "has-success has-feedback";
	                		}
	                	}
	                	break;
	                	
	                case "serie":
	                	if (isset(self::$cadastrar_campos['erro_serie'])) {
	                		if (self::$cadastrar_campos['erro_serie'] == "erro") {
	                			echo "has-error has-feedback";
	                		} else if (self::$cadastrar_campos['erro_serie'] == "certo") {
	                			echo "has-success has-feedback";
	                		}
	                	}
	                	break;
	                	
	                case "preco":
	                	if (isset(self::$cadastrar_campos['erro_preco'])) {
	                		if (self::$cadastrar_campos['erro_preco'] == "erro") {
	                			echo "has-error has-feedback";
	                		} else if (self::$cadastrar_campos['erro_preco'] == "certo") {
	                			echo "has-success has-feedback";
	                		}
	                	}
	                	break;
	            }
        	}
		}
		
		public static function Manter_Valor($campo) {
            if (!empty(self::$cadastrar_form)) {
                if (isset(self::$cadastrar_form[$campo])) {
                    echo self::$cadastrar_form[$campo];
                }
            }
		}
		
		public static function Manter_Imagens($imagem) {
			switch ($imagem) {
				case "foto1":
					if (!empty($_SESSION['imagens_tmp'][1])) {
						echo Controller_Cadastrar::Pegar_Imagem_URL($_SESSION['imagens_tmp'][1]);
					} else {
						echo "/application/view/resources/img/imagem_indisponivel.png";
					}
					break;
				
				case "foto2":
					if (!empty($_SESSION['imagens_tmp'][2])) {
						echo Controller_Cadastrar::Pegar_Imagem_URL($_SESSION['imagens_tmp'][2]);
					} else {
						echo "/application/view/resources/img/imagem_indisponivel.png";
					}
					break;
				
				case "foto3":
					if (!empty($_SESSION['imagens_tmp'][3])) {
						echo Controller_Cadastrar::Pegar_Imagem_URL($_SESSION['imagens_tmp'][3]);
					} else {
						echo "/application/view/resources/img/imagem_indisponivel.png";
					}
					break;
			}
		}
		
		public static function Carregar_Categorias() {
			ob_start();
			$categorias = Controller_Cadastrar::Buscar_Categorias();
			$categorias_selecionadas = array();
			$categorias_compativeis = null;
			
			if (!empty($_SESSION['compatibilidade']['categoria'])) {
				$categorias_selecionadas = $_SESSION['compatibilidade']['categoria'];
				$categorias_compativeis = Controller_Cadastrar::Buscar_Categorias_Compativeis(current($categorias_selecionadas));
			}
			
			foreach ($categorias as $categoria) {
				if (isset($categorias_selecionadas[$categoria->get_id()])) {
					if (in_array($categoria->get_id(), $categorias_compativeis)) {
						echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checked checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Categoria(this)\" checked=\"checked\" id=\"".$categoria->get_id()."\" name=\"categoria[]\" value=\"".$categoria->get_id()."\"><label>".$categoria->get_nome()."</label></div></div>";
					} else {
						unset($_SESSION['compatibilidade']['categoria'][$categoria->get_id()]);
						ob_end_clean();
						self::Carregar_Categorias();
						break;
					}
				} else {
					if (!empty($categorias_compativeis)) {
						if (in_array($categoria->get_id(), $categorias_compativeis)) {
							echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Categoria(this)\" id=\"".$categoria->get_id()."\" name=\"categoria[]\" value=\"".$categoria->get_id()."\"><label>".$categoria->get_nome()."</label></div></div>";
						} else {
							echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui disabled checkbox\"><input type=\"checkbox\" disabled=\"disabled\" onchange=\"Carregar_Categoria(this)\" id=\"".$categoria->get_id()."\" name=\"categoria[]\" value=\"".$categoria->get_id()."\"><label>".$categoria->get_nome()."</label></div></div>";
						}
					} else {
						echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Categoria(this)\" id=\"".$categoria->get_id()."\" name=\"categoria[]\" value=\"".$categoria->get_id()."\"><label>".$categoria->get_nome()."</label></div></div>";
					}
				}
			}
			
			ob_end_flush();
		}
		
		public static function Carregar_Marcas() {
			if (!empty($_SESSION['compatibilidade']['categoria'])) {
				$categorias_selecionadas = $_SESSION['compatibilidade']['categoria'];
				
				ob_start();
				$categorias_selecionadas = array_reverse($categorias_selecionadas);
				$marcas_selecionadas = array();
				$marcas_compativeis = null;
				
				if (!empty($_SESSION['compatibilidade']['marca'])) {
					$marcas_selecionadas = $_SESSION['compatibilidade']['marca'];
					$marcas_compativeis = Controller_Cadastrar::Buscar_Marcas_Compativeis(current($marcas_selecionadas));
				}
				
				foreach ($categorias_selecionadas as $categoria) {
					$marcas = Controller_Cadastrar::Buscar_Marcas_Por_Categoria($categoria);
					$nome_categoria = Controller_Cadastrar::Buscar_Categoria_Por_Id($categoria)->get_nome();
					
					echo "<div class=\"container-fluid borda_PanelPeca\">";
					echo "<label class=\"titulo\">$nome_categoria</label>";
					
					if (!empty($marcas) AND $marcas !== false) {
						foreach ($marcas as $marca) {
							if (isset($marcas_selecionadas[$marca->get_id()])) {
								if (in_array($marca->get_id(), $marcas_compativeis)) {
									echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checked checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Marca(this)\" checked=\"checked\" id=\"".$marca->get_id()."\" name=\"marca[]\" value=\"".$marca->get_id()."\"><label>".$marca->get_nome()."</label></div></div>";
								} else {
									unset($_SESSION['compatibilidade']['marca'][$marca->get_id()]);
									ob_end_clean();
									self::Carregar_Marcas();
									break 2;
								}
							} else {
								if (!empty($marcas_compativeis)) {
									if (in_array($marca->get_id(), $marcas_compativeis)) {
										echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Marca(this)\" id=\"".$marca->get_id()."\" name=\"marca[]\" value=\"".$marca->get_id()."\"><label>".$marca->get_nome()."</label></div></div>";
									} else {
										echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui disabled checkbox\"><input type=\"checkbox\" disabled=\"disabled\" onchange=\"Carregar_Marca(this)\" id=\"".$marca->get_id()."\" name=\"marca[]\" value=\"".$marca->get_id()."\"><label>".$marca->get_nome()."</label></div></div>";
									}
								} else {
									echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Marca(this)\" id=\"".$marca->get_id()."\" name=\"marca[]\" value=\"".$marca->get_id()."\"><label>".$marca->get_nome()."</label></div></div>";
								}
							}
						}
					} else {
						echo "<label class=\"linha_inteira\">Nenhuma Marca Cadastrado Para a Categoria: $nome_categoria</label>";
					}
					
					echo "<div class=\"esp_tit_cad_pec col-lg-12 col-md-12 col-sm-12 col-xs-12\"></div>";
					echo "</div>";
				}
				
				ob_end_flush();
			} else {
				echo "Selecione a Categoria do Veiculo...";
			}
		}
		
		public static function Carregar_Modelos() {
			if (!empty($_SESSION['compatibilidade']['categoria'])) {
				$categorias_selecionadas = $_SESSION['compatibilidade']['categoria'];
				
				if (!empty($_SESSION['compatibilidade']['marca'])) {
					$marcas_selecionadas = $_SESSION['compatibilidade']['marca'];
					
					ob_start();
					$marcas_selecionadas = array_reverse($marcas_selecionadas);
					$modelos_selecionados = array();
					$modelos_compativeis = null;
					
					if (!empty($_SESSION['compatibilidade']['modelo'])) {
						$modelos_selecionados = $_SESSION['compatibilidade']['modelo'];
						$modelos_compativeis = Controller_Cadastrar::Buscar_Modelos_Compativeis(current($modelos_selecionados));
					}
					
					foreach ($marcas_selecionadas as $marca) {
						$modelos = Controller_Cadastrar::Buscar_Modelos_Por_Marca($marca);
						$titulo_marca = Controller_Cadastrar::Buscar_Marca_Por_Id($marca);
						$titulo_categoria = Controller_Cadastrar::Buscar_Categoria_Por_Id($titulo_marca->get_categoria_id());
						
						echo "<div class=\"container-fluid borda_PanelPeca\">";
						echo "<label class=\"titulo\">".$titulo_marca->get_nome()." <i class=\"glyphicon glyphicon-hand-right\"></i> ".$titulo_categoria->get_nome()."</label>";
						
						if (!empty($modelos) AND $modelos !== false) {
							foreach ($modelos as $modelo) {
								if (isset($modelos_selecionados[$modelo->get_id()])) {
									if (in_array($modelo->get_id(), $modelos_compativeis)) {
										echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checked checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Modelo(this)\" checked=\"checked\" id=\"".$modelo->get_id()."\" name=\"modelo[]\" value=\"".$modelo->get_id()."\"><label>".$modelo->get_nome()."</label></div></div>";
									} else {
										unset($_SESSION['compatibilidade']['modelo'][$modelo->get_id()]);
										ob_end_clean();
										self::Carregar_Modelos();
										break 2;
									}
								} else {
									if (!empty($modelos_compativeis)) {
										if (in_array($modelo->get_id(), $modelos_compativeis)) {
											echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Modelo(this)\" id=\"".$modelo->get_id()."\" name=\"modelo[]\" value=\"".$modelo->get_id()."\"><label>".$modelo->get_nome()."</label></div></div>";
										} else {
											echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui disabled checkbox\"><input type=\"checkbox\" disabled=\"disabled\" onchange=\"Carregar_Modelo(this)\" id=\"".$modelo->get_id()."\" name=\"modelo[]\" value=\"".$modelo->get_id()."\"><label>".$modelo->get_nome()."</label></div></div>";
										}
									} else {
										echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Modelo(this)\" id=\"".$modelo->get_id()."\" name=\"modelo[]\" value=\"".$modelo->get_id()."\"><label>".$modelo->get_nome()."</label></div></div>";
									}
								}
							}
						} else {
							echo "<label class=\"linha_inteira\">Nenhum Modelo Cadastrado Para a Marca: ".$titulo_marca->get_nome()." da Categoria: ".$titulo_categoria->get_nome()."</label>";
						}
						
						echo "<div class=\"esp_tit_cad_pec col-lg-12 col-md-12 col-sm-12 col-xs-12\"></div>";
						echo "</div>";
					}
					
					ob_end_flush();
				} else {
					echo "Selecione a Marca do Veiculo...";
				}
			} else {
				echo "Selecione a Categoria e a Marca do Veiculo...";
			}
		}

		public static function Carregar_Versoes() {
			if (!empty($_SESSION['compatibilidade']['categoria'])) {
				$categorias_selecionadas = $_SESSION['compatibilidade']['categoria'];
				
				if (!empty($_SESSION['compatibilidade']['marca'])) {
					$marcas_selecionadas = $_SESSION['compatibilidade']['marca'];
					
					if (!empty($_SESSION['compatibilidade']['modelo'])) {
						$modelos_selecionados = $_SESSION['compatibilidade']['modelo'];
						
						ob_start();
						$modelos_selecionados = array_reverse($modelos_selecionados);
						$versoes_selecionadas = array();
						$versoes_compativeis = null;
						
						if (!empty($_SESSION['compatibilidade']['versao'])) {
							$versoes_selecionadas = $_SESSION['compatibilidade']['versao'];
							$versoes_compativeis = Controller_Cadastrar::Buscar_Versoes_Compativeis(current($versoes_selecionadas));
						}
						
						foreach ($modelos_selecionados as $modelo) {
							$versoes = Controller_Cadastrar::Buscar_Versoes_Por_Modelo($modelo);
							$titulo_modelo = Controller_Cadastrar::Buscar_Modelo_Por_Id($modelo);
							$titulo_marca = Controller_Cadastrar::Buscar_Marca_Por_Id($titulo_modelo->get_marca_id());
							$titulo_categoria = Controller_Cadastrar::Buscar_Categoria_Por_Id($titulo_marca->get_categoria_id());
							
							echo "<div class=\"container-fluid borda_PanelPeca\">";
							echo "<label class=\"titulo\">".$titulo_modelo->get_nome()." <i class=\"glyphicon glyphicon-hand-right\"></i> ".$titulo_marca->get_nome()." <i class=\"glyphicon glyphicon-hand-right\"></i> ".$titulo_categoria->get_nome()."</label>";
							
							if (!empty($versoes) AND $versoes !== false) {
								foreach ($versoes as $versao) {
									if (isset($versoes_selecionadas[$versao->get_id()])) {
										if (in_array($versao->get_id(), $versoes_compativeis)) {
											echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checked checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Versao(this)\" checked=\"checked\" id=\"".$versao->get_id()."\" name=\"versao[]\" value=\"".$versao->get_id()."\"><label>".$versao->get_nome()."</label></div></div>";
										} else {
											unset($_SESSION['compatibilidade']['versao'][$versao->get_id()]);
											ob_end_clean();
											self::Carregar_Versoes();
											break 2;
										}
									} else {
										if (isset($versoes_compativeis)) {
											if (in_array($versao->get_id(), $versoes_compativeis)) {
												echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Versao(this)\" id=\"".$versao->get_id()."\" name=\"versao[]\" value=\"".$versao->get_id()."\"><label>".$versao->get_nome()."</label></div></div>";
											} else {
												echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui disabled checkbox\"><input type=\"checkbox\" disabled=\"disabled\" onchange=\"Carregar_Versao(this)\" id=\"".$versao->get_id()."\" name=\"versao[]\" value=\"".$versao->get_id()."\"><label>".$versao->get_nome()."</label></div></div>";
											}
										} else {
											echo "<div class=\"col-md-3 col-sm-4 col-xs-12\"><div class=\"ui checkbox\"><input type=\"checkbox\" onchange=\"Carregar_Versao(this)\" id=\"".$versao->get_id()."\" name=\"versao[]\" value=\"".$versao->get_id()."\"><label>".$versao->get_nome()."</label></div></div>";
										}
									}
								}
							} else {
								echo "<label class=\"linha_inteira\">Nenhuma Versão Cadastrada Para o Modelo: ".$titulo_modelo->get_nome()." da Marca: ".$titulo_marca->get_nome()." da Categoria: ".$titulo_categoria->get_nome()."</label>";
							}
							
							echo "<div class=\"esp_tit_cad_pec col-lg-12 col-md-12 col-sm-12 col-xs-12\"></div>";
							echo "</div>";
						}
						
						ob_end_flush();
					} else {
						echo "Selecione o Modelo do Veiculo...";
					}
				} else {
					echo "Selecione a Marca e o Modelo do Veiculo...";
				}
			} else {
				echo "Selecione a Categoria a Marca e o Modelo do Veiculo...";
			}
		}

		public static function Carregar_Anos() {
			if (!empty($_SESSION['compatibilidade']['categoria'])) {
				$categorias_selecionadas = $_SESSION['compatibilidade']['categoria'];
				
				if (!empty($_SESSION['compatibilidade']['marca'])) {
					$marcas_selecionadas = $_SESSION['compatibilidade']['marca'];
					
					$anos_selecionados = array();
					
					if (!empty($_SESSION['compatibilidade']['ano'])) {
						$anos_selecionados = $_SESSION['compatibilidade']['ano'];
					}
					
					foreach ($marcas_selecionadas as $marca_selecionada) {
						if (!empty($_SESSION['compatibilidade']['modelo'])) {
							$modelos_selecionados = $_SESSION['compatibilidade']['modelo'];
							
							foreach ($modelos_selecionados as $modelo_selecionado) {
								if (Controller_Cadastrar::Buscar_Marca_Id_Por_Modelo($modelo_selecionado) == $marca_selecionada) {
									if (!empty($_SESSION['compatibilidade']['versao'])) {
										$versoes_selecionadas = $_SESSION['compatibilidade']['versao'];
										
										foreach ($versoes_selecionadas as $versao_selecionada) {
											if (Controller_Cadastrar::Buscar_Modelo_Id_Por_Versao($versao_selecionada) == $modelo_selecionado) {
												self::Carregar_Anos_Versao($versao_selecionada, $anos_selecionados);
											}
										}
									} else {
										self::Carregar_Anos_Modelo($modelo_selecionado, $anos_selecionados);
									}
								}
							}
						} else {
							self::Carregar_Anos_Marca($marca_selecionada, $anos_selecionados);
						}
					}
				} else {
					echo "Selecione a Marca e o Modelo ou Versão do Veiculo...";
				}
			} else {
				echo "Selecione a Categoria a Marca e o Modelo ou Versão do Veiculo...";
			}
		}

		private static function Carregar_Anos_Marca($marca, $anos_selecionados) {
			$titulo_marca = Controller_Cadastrar::Buscar_Marca_Por_Id($marca);
			$titulo_categoria = Controller_Cadastrar::Buscar_Categoria_Por_Id($titulo_marca->get_categoria_id());
			echo "<div class=\"container-fluid borda_PanelPeca divAno\">";
			echo "<div class=\"col-md-7 col-sm-6 col-xs-12\"><label>".$titulo_categoria->get_nome()." <i class=\"lbPanel glyphicon glyphicon-hand-right\"></i> ".$titulo_marca->get_nome()."</label></div>";
			echo "<div class=\"col-md-5 col-sm-6 col-xs-12\">";
			echo "<div class=\"row\">";
			echo "<div class=\"col-md-6 col-sm-6 col-xs-6\">";
			echo "<div class=\"input-group linha_inteira\">";
			echo "<select id=\"ano_ma_de\" name=\"ano_ma_".$titulo_marca->get_id()."_de\" class=\"form-control form_select\">";
			echo "<option value=\"0\">Ano De</option>";
			if (isset($anos_selecionados['ano_ma_'.$marca.'_de'])) {
				self::Mostrar_Anos($anos_selecionados['ano_ma_'.$marca.'_de']);
			} else {
				self::Mostrar_Anos();
			}
			echo "</select>";
			echo "<span class=\"glyphicon glyphicon-menu-down form-control-feedback\"></span>";
			echo "</div>";//input-group
			echo "</div>";//col-md-6 col-sm-6 col-xs-6
			echo "<div class=\"col-md-6 col-sm-6 col-xs-6\">";
			echo "<div class=\"input-group linha_inteira\">";
			echo "<select id=\"ano_ma_ate\" name=\"ano_ma_".$titulo_marca->get_id()."_ate\" class=\"form-control form_select\">";
			echo "<option value=\"0\">Ano Até</option>";
			if (isset($anos_selecionados['ano_ma_'.$marca.'_ate'])) {
				self::Mostrar_Anos($anos_selecionados['ano_ma_'.$marca.'_ate']);
			} else {
				self::Mostrar_Anos();
			}
			echo "</select>";
			echo "<span class=\"glyphicon glyphicon-menu-down form-control-feedback\"></span>";
			echo "</div>";//input-group
			echo "</div>";//col-md-6 col-sm-6 col-xs-6
			echo "</div>";//row
			echo "</div>";//col-md-5 col-sm-6 col-xs-12
			echo "</div>";//container-fluid
		}

		private static function Carregar_Anos_Modelo($modelo, $anos_selecionados) {
			$titulo_modelo = Controller_Cadastrar::Buscar_Modelo_Por_Id($modelo);
			$titulo_marca = Controller_Cadastrar::Buscar_Marca_Por_Id($titulo_modelo->get_marca_id());
			$titulo_categoria = Controller_Cadastrar::Buscar_Categoria_Por_Id($titulo_marca->get_categoria_id());
			echo "<div class=\"container-fluid borda_PanelPeca divAno\">";
			echo "<div class=\"col-md-7 col-sm-6 col-xs-12\"><label>".$titulo_categoria->get_nome()." <i class=\"lbPanel glyphicon glyphicon-hand-right\"></i> ".$titulo_marca->get_nome()." <i class=\"lbPanel glyphicon glyphicon-hand-right\"></i> ".$titulo_modelo->get_nome()."</label></div>";
			echo "<div class=\"col-md-5 col-sm-6 col-xs-12\">";
			echo "<div class=\"row\">";
			echo "<div class=\"col-md-6 col-sm-6 col-xs-6\">";
			echo "<div class=\"input-group linha_inteira\">";
			echo "<select id=\"ano_mo_de\" name=\"ano_mo_".$titulo_modelo->get_id()."_de\" class=\"form-control form_select\">";
			echo "<option value=\"0\">Ano De</option>";
			if (isset($anos_selecionados['ano_mo_'.$modelo.'_de'])) {
				self::Mostrar_Anos($anos_selecionados['ano_mo_'.$modelo.'_de']);
			} else {
				self::Mostrar_Anos();
			}
			echo "</select>";
			echo "<span class=\"glyphicon glyphicon-menu-down form-control-feedback\"></span>";
			echo "</div>";//input-group
			echo "</div>";//col-md-6 col-sm-6 col-xs-6
			echo "<div class=\"col-md-6 col-sm-6 col-xs-6\">";
			echo "<div class=\"input-group linha_inteira\">";
			echo "<select id=\"ano_mo_ate\" name=\"ano_mo_".$titulo_modelo->get_id()."_ate\" class=\"form-control form_select\">";
			echo "<option value=\"0\">Ano Até</option>";
			if (isset($anos_selecionados['ano_mo_'.$modelo.'_ate'])) {
				self::Mostrar_Anos($anos_selecionados['ano_mo_'.$modelo.'_ate']);
			} else {
				self::Mostrar_Anos();
			}
			echo "</select>";
			echo "<span class=\"glyphicon glyphicon-menu-down form-control-feedback\"></span>";
			echo "</div>";//input-group
			echo "</div>";//col-md-6 col-sm-6 col-xs-6
			echo "</div>";//row
			echo "</div>";//col-md-5 col-sm-6 col-xs-12
			echo "</div>";//container-fluid
		}

		private static function Carregar_Anos_Versao($versao, $anos_selecionados) {
			$titulo_versao = Controller_Cadastrar::Buscar_Versao_Por_Id($versao);
			$titulo_modelo = Controller_Cadastrar::Buscar_Modelo_Por_Id($titulo_versao->get_modelo_id());
			$titulo_marca = Controller_Cadastrar::Buscar_Marca_Por_Id($titulo_modelo->get_marca_id());
			$titulo_categoria = Controller_Cadastrar::Buscar_Categoria_Por_Id($titulo_marca->get_categoria_id());
			echo "<div class=\"container-fluid borda_PanelPeca divAno\">";
			echo "<div class=\"col-md-7 col-sm-6 col-xs-12\"><label>".$titulo_categoria->get_nome()." <i class=\"lbPanel glyphicon glyphicon-hand-right\"></i> ".$titulo_marca->get_nome()." <i class=\"lbPanel glyphicon glyphicon-hand-right\"></i> ".$titulo_modelo->get_nome()." <i class=\"lbPanel glyphicon glyphicon-hand-right\"></i> ".$titulo_versao->get_nome()."</label></div>";
			echo "<div class=\"col-md-5 col-sm-6 col-xs-12\">";
			echo "<div class=\"row\">";
			echo "<div class=\"col-md-6 col-sm-6 col-xs-6\">";
			echo "<div class=\"input-group linha_inteira\">";
			echo "<select id=\"ano_vs_de\" name=\"ano_vs_".$titulo_versao->get_id()."_de\" class=\"form-control form_select\">";
			echo "<option value=\"0\">Ano De</option>";
			if (isset($anos_selecionados['ano_vs_'.$versao.'_de'])) {
				self::Mostrar_Anos($anos_selecionados['ano_vs_'.$versao.'_de']);
			} else {
				self::Mostrar_Anos();
			}
			echo "</select>";
			echo "<span class=\"glyphicon glyphicon-menu-down form-control-feedback\"></span>";
			echo "</div>";//input-group
			echo "</div>";//col-md-6 col-sm-6 col-xs-6
			echo "<div class=\"col-md-6 col-sm-6 col-xs-6\">";
			echo "<div class=\"input-group linha_inteira\">";
			echo "<select id=\"ano_vs_ate\" name=\"ano_vs_".$titulo_versao->get_id()."_ate\" class=\"form-control form_select\">";
			echo "<option value=\"0\">Ano Até</option>";
			if (isset($anos_selecionados['ano_vs_'.$versao.'_ate'])) {
				self::Mostrar_Anos($anos_selecionados['ano_vs_'.$versao.'_ate']);
			} else {
				self::Mostrar_Anos();
			}
			echo "</select>";
			echo "<span class=\"glyphicon glyphicon-menu-down form-control-feedback\"></span>";
			echo "</div>";//input-group
			echo "</div>";//col-md-6 col-sm-6 col-xs-6
			echo "</div>";//row
			echo "</div>";//col-md-5 col-sm-6 col-xs-12
			echo "</div>";//container-fluid
		}

		public static function Mostrar_Status() {
			$satus_pecas = Controller_Cadastrar::Buscar_Status_Pecas();
			
			foreach ($satus_pecas as $status_peca) {
				if (isset(self::$cadastrar_form['status'])) {
					if (self::$cadastrar_form['status'] == $status_peca->get_id()) {
						echo "<option selected value=\"".$status_peca->get_id()."\">".$status_peca->get_nome()."</option>";
					} else {
						echo "<option value=\"".$status_peca->get_id()."\">".$status_peca->get_nome()."</option>";
					}
				} else {
					echo "<option value=\"".$status_peca->get_id()."\">".$status_peca->get_nome()."</option>";
				}
			}
		}
		
        private static function Mostrar_Anos($ano = null) {
            if (isset($ano)) {
	            for ($i=2017; $i >= 1900; $i--) {
	            	if ($ano == $i) {
	            		echo "<option selected value=\"".$i."\">".$i."</option>";
	            	} else {
	            		echo "<option value=\"".$i."\">".$i."</option>";
	            	}
				}
            } else {
            	for ($i=2017; $i >= 1900; $i--) {
            		echo "<option value=\"".$i."\">".$i."</option>";
				}
        	}
		}
    }
?>