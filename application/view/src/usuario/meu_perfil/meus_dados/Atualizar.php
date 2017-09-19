<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
    
    use application\model\object\Entidade as Object_Entidade;
    use application\model\object\Usuario as Object_Usuario;
    use application\controller\usuario\meu_perfil\meus_dados\Atualizar as Controller_Atualizar;
    use application\view\src\include_page\menu\Usuario as View_Usuario;
    
    class Atualizar {
    	
        function __construct(?int $status = null) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $atualizar_erros;
        private static $atualizar_sucesso;
        private static $atualizar_campos;
        private static $atualizar_form;
        private static $entidade_form;
        private static $usuario_form;
        
        public function set_atualizar_erros(?array $atualizar_erros = null) : void {
        	self::$atualizar_erros = $atualizar_erros;
        }
        
        public function set_atualizar_campos(?array $atualizar_campos = null) : void {
        	self::$atualizar_campos = $atualizar_campos;
        }
        
        public function set_atualizar_form(?array $atualizar_form = null) : void {
        	self::$atualizar_form = $atualizar_form;
        }
        
        public function set_entidade_form(?Object_Entidade $entidade_form = null) : void {
        	self::$entidade_form = $entidade_form;
        }
        
        public function set_usuario_form(?Object_Usuario $usuario_form = null) : void {
        	self::$usuario_form = $usuario_form;
        }
        
        public function set_atualizar_sucesso(?array $atualizar_sucesso = null) : void {
        	self::$atualizar_sucesso = $atualizar_sucesso;
        }
        
        public function Executar() : void {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/meus_dados/Atualizar.php';
        }
        
        public static function Incluir_Menu_Usuario() : void {
        	new View_Usuario(self::$status_usuario, array('meus-dados', 'atualizar'));
        }
        
        public static function Manter_Valor(?string $quadro = null, ?string $campo = null) : void {
            if (!empty(self::$atualizar_form)) {
                if (isset(self::$atualizar_form[$campo])) {
                    echo self::$atualizar_form[$campo];
                } else {
                    self::Pegar_Valor($quadro, $campo);
                }
            } else {
                self::Pegar_Valor($quadro, $campo);
            }
        }
		
		public static function Manter_Imagem() : void {
			if (isset($_SESSION['imagem_tmp'])) {
				if ($_SESSION['imagem_tmp'] == "del") {
					echo "/application/view/resources/img/imagem_indisponivel.png";
				} else {
					echo Controller_Atualizar::Pegar_Imagem_URL($_SESSION['imagem_tmp']);
				}
			} else {
				if (!empty(self::$entidade_form->get_imagem())) {
					echo str_replace("@", "200x150", self::$entidade_form->get_imagem());
				} else {
					echo "/application/view/resources/img/imagem_indisponivel.png";
				}
			}
		}
        
        public static function Mostrar_Erros() : void {
            if (!empty(self::$atualizar_erros)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$atualizar_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
                }
                echo "</div></div>";
            }
        }
        
        public static function Mostrar_Sucesso() : void {
            if (!empty(self::$atualizar_sucesso)) {
				echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$atualizar_sucesso as $value) {
                	echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
				}
				echo "</div></div>";
            }
        }
        
        public static function Incluir_Classe_Erros(?string $quadro = null, ?string $campo = null) : void {
            switch ($quadro) {
                
                case "usuario":
                    self::Incluir_Classe_Erros_Usuario($campo);
                    break;
                    
                case "entidade":
                    self::Incluir_Classe_Erros_Entidade($campo);
                    break;
                    
            }            
        }
        
        private function Incluir_Classe_Erros_Usuario(?string $campo = null) : void {
        	if (!empty(self::$atualizar_campos)) {
	            switch ($campo) {
	            	case "fone":
	            		if (isset(self::$atualizar_campos['erro_fone'])) {
	            			if (self::$atualizar_campos['erro_fone'] == "erro") {
	            				echo "has-error has-feedback";
	            			} else if (self::$atualizar_campos['erro_fone'] == "certo") {
	            				echo "has-success has-feedback";
	            			}
	            		}
	            		break;
	            	
	            	case "fone_alternativo":
	            		if (isset(self::$atualizar_campos['erro_fone_alternativo'])) {
	            			if (self::$atualizar_campos['erro_fone_alternativo'] == "erro") {
	            				echo "has-error has-feedback";
	            			} else if (self::$atualizar_campos['erro_fone_alternativo'] == "certo") {
	            				echo "has-success has-feedback";
	            			}
	            		}
	            		break;
	            	
	            	case "email_alternativo":
	            		if (isset(self::$atualizar_campos['erro_email_alternativo'])) {
	            			if (self::$atualizar_campos['erro_email_alternativo'] == "erro") {
	            				echo "has-error has-feedback";
	            			} else if (self::$atualizar_campos['erro_email_alternativo'] == "certo") {
	            				echo "has-success has-feedback";
	            			}
	            		}
	            		break;
	            	
	                case "nome":
	                	if (isset(self::$atualizar_campos['erro_nome'])) {
		                    if (self::$atualizar_campos['erro_nome'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_nome'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                
	                case "email":
	                	if (isset(self::$atualizar_campos['erro_email'])) {
		                    if (self::$atualizar_campos['erro_email'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_email'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
					
	                case "confemail":
	                	if (isset(self::$atualizar_campos['erro_confemail'])) {
		                    if (self::$atualizar_campos['erro_confemail'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_confemail'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	            }
            }
        }
        
        private function Incluir_Classe_Erros_Entidade(?string $campo = null) : void {
        	if (!empty(self::$atualizar_campos)) {
	            switch ($campo) {
	            	
	            	case "site":
	            		if (isset(self::$atualizar_campos['erro_site'])) {
	            			if (self::$atualizar_campos['erro_site'] == "erro") {
	            				echo "has-error has-feedback";
	            			} else if (self::$atualizar_campos['erro_site'] == "certo") {
	            				echo "has-success has-feedback";
	            			}
	            		}
	            		break;
	            		
	                case "nome_comercial":
	                	if (isset(self::$atualizar_campos['erro_nome_comercial'])) {
		                    if (self::$atualizar_campos['erro_nome_comercial'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_nome_comercial'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                
	                case "cpf_cnpj":
	                	if (isset(self::$atualizar_campos['erro_cpf_cnpj'])) {
		                    if (self::$atualizar_campos['erro_cpf_cnpj'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_cpf_cnpj'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	            }
            }
        }
        
        private static function Pegar_Valor(?string $quadro = null, ?string $campo = null) : void {
        	switch ($quadro) {
        		case "usuario":
        			if ($campo == "nome") {
        				echo self::$usuario_form->get_nome();
        			} else if ($campo == "email") {
        				echo self::$usuario_form->get_email();
        			} else if ($campo == "confemail") {
        				echo self::$usuario_form->get_email();
        			} else if ($campo == "fone") {
        				echo self::$usuario_form->get_fone();
        			} else if ($campo == "fone_alternativo") {
        				echo self::$usuario_form->get_fone_alternativo();
        			} else if ($campo == "email_alternativo") {
        				echo self::$usuario_form->get_email_alternativo();
        			}
        			break;
        
        		case "entidade":
        			if ($campo == "nome_comercial") {
        				echo self::$entidade_form->get_nome_comercial();
        			} else if ($campo == "cpf_cnpj") {
        				echo self::$entidade_form->get_cpf_cnpj();
        			} else if ($campo == "site") {
        				echo self::$entidade_form->get_site();
        			}
        			break;
        	}
        }
    }
?>