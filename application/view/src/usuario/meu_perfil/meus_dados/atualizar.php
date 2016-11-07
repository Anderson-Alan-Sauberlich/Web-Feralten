<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
    
    require_once RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php';
    require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
    
    use application\controller\usuario\meu_perfil\meus_dados\Atualizar as Controller_Atualizar;
    use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
    
    @session_start();
    
    class Atualizar {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $atualizar_erros;
        private static $atualizar_sucesso;
        private static $atualizar_campos;
        private static $atualizar_form;
        private static $dados_usuario_form;
        private static $usuario_form;
        
        public function set_atualizar_erros($atualizar_erros) {
        	self::$atualizar_erros = $atualizar_erros;
        }
        
        public function set_atualizar_campos($atualizar_campos) {
        	self::$atualizar_campos = $atualizar_campos;
        }
        
        public function set_atualizar_form($atualizar_form) {
        	self::$atualizar_form = $atualizar_form;
        }
        
        public function set_dados_usuario_form($dados_usuario_form) {
        	self::$dados_usuario_form = $dados_usuario_form;
        }
        
        public function set_usuario_form($usuario_form) {
        	self::$usuario_form = $usuario_form;
        }
        
        public function set_atualizar_sucesso($atualizar_sucesso) {
        	self::$atualizar_sucesso = $atualizar_sucesso;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/meus_dados/atualizar.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('meus-dados', 'atualizar'));
        }
        
        public static function Manter_Valor($quadro, $campo) {
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
		
		public static function Manter_Imagem() {
			if (isset($_SESSION['imagem_tmp'])) {
				if ($_SESSION['imagem_tmp'] == "del") {
					echo "/application/view/resources/img/imagem_indisponivel.png";
				} else {
					echo Controller_Atualizar::Pegar_Imagem_URL($_SESSION['imagem_tmp']);
				}
			} else {
				if (!empty(self::$dados_usuario_form->get_imagem())) {
					echo str_replace("@", "200x150", self::$dados_usuario_form->get_imagem());
				} else {
					echo "/application/view/resources/img/imagem_indisponivel.png";
				}
			}
		}
        
        public static function Mostrar_Erros() {
            if (!empty(self::$atualizar_erros)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$atualizar_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
                }
                echo "</div></div>";
            }
        }
        
        public static function Mostrar_Sucesso() {
            if (!empty(self::$atualizar_sucesso)) {
				echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$atualizar_sucesso as $value) {
                	echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
				}
				echo "</div></div>";
            }
        }
        
        public static function Incluir_Classe_Erros($quadro, $campo) {
            switch ($quadro) {
                
                case "login":
                    self::Incluir_Classe_Erros_Usuario($campo);
                    break;
                    
                case "dadosusuario":
                    self::Incluir_Classe_Erros_DadosUsuario($campo);
                    break;
                    
                case "contato":
                    self::Incluir_Classe_Erros_Contato($campo);
                    break;
            }            
        }
        
        private function Incluir_Classe_Erros_Usuario($campo) {
        	if (!empty(self::$atualizar_campos)) {
	            switch ($campo) {
	                
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
        
        private function Incluir_Classe_Erros_DadosUsuario($campo) {
        	if (!empty(self::$atualizar_campos)) {
	            switch ($campo) {
	                
	                case "nomedadosusuario":
	                	if (isset(self::$atualizar_campos['erro_nomedadosusuario'])) {
		                    if (self::$atualizar_campos['erro_nomedadosusuario'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_nomedadosusuario'] == "certo") {
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
        
        private function Incluir_Classe_Erros_Contato($campo) {
        	if (!empty(self::$atualizar_campos)) {
	            switch ($campo) {
	                
	                case "fone1":
	                	if (isset(self::$atualizar_campos['erro_fone1'])) {
		                    if (self::$atualizar_campos['erro_fone1'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_fone1'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "fone2":
	                	if (isset(self::$atualizar_campos['erro_fone2'])) {
		                    if (self::$atualizar_campos['erro_fone2'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_fone2'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "emailcontato":
	                	if (isset(self::$atualizar_campos['erro_emailcontato'])) {
		                    if (self::$atualizar_campos['erro_emailcontato'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$atualizar_campos['erro_emailcontato'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	            }
			}
        }
        
        private static function Pegar_Valor($quadro, $campo) {
        	switch ($quadro) {
        		case "login":
        			if ($campo == "nome") {
        				echo self::$usuario_form->get_nome();
        			} else if ($campo == "email") {
        				echo self::$usuario_form->get_email();
        			} else if ($campo == "confemail") {
        				echo self::$usuario_form->get_email();
        			}
        			break;
        
        		case "dadosusuario":
        			if ($campo == "nomedadosusuario") {
        				echo self::$dados_usuario_form->get_nome_fantasia();
        			} else if ($campo == "cpf_cnpj") {
        				echo self::$dados_usuario_form->get_cpf_cnpj();
        			} else if ($campo == "site") {
        				echo self::$dados_usuario_form->get_site();
        			} else if ($campo == "fone1") {
        				echo self::$dados_usuario_form->get_telefone1();
        			} else if ($campo == "fone2") {
        				echo self::$dados_usuario_form->get_telefone2();
        			} else if ($campo == "emailcontato") {
        				echo self::$dados_usuario_form->get_email();
        			}
        			break;
        	}
        }
    }
?>