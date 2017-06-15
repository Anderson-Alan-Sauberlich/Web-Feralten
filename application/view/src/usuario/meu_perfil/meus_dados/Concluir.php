<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
	
    use application\controller\usuario\meu_perfil\meus_dados\Concluir as Controller_Concluir;
	use application\view\src\include_page\menu\Usuario as View_Usuario;
    
    class Concluir {
    	
        function __construct(?int $status = null) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $concluir_erros;
        private static $concluir_campos;
        private static $concluir_form;
        
        public function set_concluir_erros(?array $concluir_erros = null) : void {
        	self::$concluir_erros = $concluir_erros;
        }
        
        public function set_concluir_campos(?array $concluir_campos = null) : void {
        	self::$concluir_campos = $concluir_campos;
        }
        
        public function set_concluir_form(?array $concluir_form = null) : void {
        	self::$concluir_form = $concluir_form;
        }
        
        public function Executar() : void {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/meus_dados/Concluir.php';
        }
        
        public static function Incluir_Menu_Usuario() : void {
        	new View_Usuario(self::$status_usuario, array('meus-dados', 'concluir'));
        }
        
        public static function Manter_Valor(string $campo) : void {
            if (!empty(self::$concluir_form)) {
                if (isset(self::$concluir_form[$campo])) {
                    echo self::$concluir_form[$campo];
                }
            }
        }

		public static function Manter_Imagem() : void {
			if (isset($_SESSION['imagem_tmp'])) {
				echo Controller_Concluir::Pegar_Imagem_URL($_SESSION['imagem_tmp']);
			} else {
				echo "/application/view/resources/img/imagem_indisponivel.png";
			}
		}
        
        public static function Mostrar_Erros() : void {
            if (!empty(self::$concluir_erros)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$concluir_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                }
                echo "</div></div>";
            }
        }
        
        public static function Mostrar_Estados() : void {
            $estados = Controller_Concluir::Buscar_Todos_Estados();
            
            if (!empty($estados) AND $estados !== false) {
	            if (isset(self::$concluir_form['estado'])) {
			        foreach ($estados as $estado) {
			            if (self::$concluir_form['estado'] == $estado->get_id()) {
			                echo "<option selected value=\"".$estado->get_id()."\">".$estado->get_uf()." - ".$estado->get_nome()."</option>";
			            } else {
			                echo "<option value=\"".$estado->get_id()."\">".$estado->get_uf()." - ".$estado->get_nome()."</option>";
			            }
			        }
				} else {
			        foreach ($estados as $estado) {
			            echo "<option value=\"".$estado->get_id()."\">".$estado->get_uf()." - ".$estado->get_nome()."</option>";
			        }
				}
            } else {
            	echo '<option value="">Erro</option>';
            }
        }
        
        public static function Mostrar_Cidades(?int $estado = null) : void {
			$id_estado;
				
			if (isset($estado)) {
				$id_estado = $estado;
			} else if (isset(self::$concluir_form['estado'])) {
				$id_estado = self::$concluir_form['estado'];
			}
			
			echo '<option value="0">Selecione sua Cidade</option>';
			
            if (isset($id_estado)) {
                $cidades = Controller_Concluir::Buscar_Cidades_Por_Estado($id_estado);
                
                if (!empty($cidades) AND $cidades !== false) {
					if (isset(self::$concluir_form['cidade'])) {
		                foreach ($cidades as $cidade) {
		                    if (self::$concluir_form['cidade'] == $cidade->get_id()) {
		                        echo "<option selected value=\"".$cidade->get_id()."\">".$cidade->get_nome()."</option>";
		                    } else {
		                        echo "<option value=\"".$cidade->get_id()."\">".$cidade->get_nome()."</option>";
		                    }
		                }
					} else {
		                foreach ($cidades as $cidade) {
		                    echo "<option value=\"".$cidade->get_id()."\">".$cidade->get_nome()."</option>";
		                }
					}
                } else {
                	echo '<option value="">Erro</option>';
                }
            }
        }
        
        public static function Incluir_Classe_Erros(string $campo) : void {
        	if (!empty(self::$concluir_campos)) {
	            switch ($campo) {
	                case "fone1":
	                	if (isset(self::$concluir_campos['erro_fone1'])) {
		                    if (self::$concluir_campos['erro_fone1'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_fone1'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "fone2":
	                	if (isset(self::$concluir_campos['erro_fone2'])) {
		                    if (self::$concluir_campos['erro_fone2'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_fone2'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "estado":
	                	if (isset(self::$concluir_campos['erro_estado'])) {
		                    if (self::$concluir_campos['erro_estado'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_estado'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "cidade":
	                	if (isset(self::$concluir_campos['erro_cidade'])) {
		                    if (self::$concluir_campos['erro_cidade'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_cidade'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "numero":
	                	if (isset(self::$concluir_campos['erro_numero'])) {
		                    if (self::$concluir_campos['erro_numero'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_numero'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "cep":
	                	if (isset(self::$concluir_campos['erro_cep'])) {
		                    if (self::$concluir_campos['erro_cep'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_cep'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "bairro":
	                	if (isset(self::$concluir_campos['erro_bairro'])) {
		                    if (self::$concluir_campos['erro_bairro'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_bairro'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "complemento":
	                	if (isset(self::$concluir_campos['erro_complemento'])) {
		                    if (self::$concluir_campos['erro_complemento'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_complemento'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "rua":
	                	if (isset(self::$concluir_campos['erro_rua'])) {
		                    if (self::$concluir_campos['erro_rua'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_rua'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "imagem":
	                	if (isset(self::$concluir_campos['erro_imagem'])) {
		                    if (self::$concluir_campos['erro_imagem'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_imagem'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "cpf_cnpj":
	                	if (isset(self::$concluir_campos['erro_cpf_cnpj'])) {
		                    if (self::$concluir_campos['erro_cpf_cnpj'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_cpf_cnpj'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "nome_comercial":
	                	if (isset(self::$concluir_campos['erro_nome_comercial'])) {
		                    if (self::$concluir_campos['erro_nome_comercial'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_nome_comercial'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "email_alternativo":
	                	if (isset(self::$concluir_campos['erro_email_alternativo'])) {
		                    if (self::$concluir_campos['erro_email_alternativo'] === "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$concluir_campos['erro_email_alternativo'] === "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "site":
	                   	if (isset(self::$concluir_campos['erro_site'])) {
	                   		if (self::$concluir_campos['erro_site'] === "erro") {
	                   			echo "has-error has-feedback";
	                   		} else if (self::$concluir_campos['erro_site'] === "certo") {
	                   			echo "has-success has-feedback";
	                   		}
	                   	}
	                   	break;
	            }
        	}
        }
    }
?>