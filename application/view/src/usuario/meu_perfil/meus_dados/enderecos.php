<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;

	require_once RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php';
	require_once RAIZ.'/application/view/src/include_page/menu/usuario.php';
	
	use application\controller\usuario\meu_perfil\meus_dados\Enderecos as Controller_Enderecos;
    use application\view\src\include_page\menu\Usuario as View_Usuario;
	
    class Enderecos {

        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $enderecos_erros;
        private static $enderecos_campos;
        private static $enderecos_form;
        private static $enderecos_sucesso;
        
        public function set_enderecos_erros($enderecos_erros) {
        	self::$enderecos_erros = $enderecos_erros;
        }
        
        public function set_enderecos_campos($enderecos_campos) {
        	self::$enderecos_campos = $enderecos_campos;
        }
        
        public function set_enderecos_form($enderecos_form) {
        	self::$enderecos_form = $enderecos_form;
        }
        
        public function set_enderecos_sucesso($enderecos_sucesso) {
        	self::$enderecos_sucesso = $enderecos_sucesso;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/meus_dados/enderecos.php';
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Usuario(self::$status_usuario, array('meus-dados', 'enderecos'));
        }
		
        public static function Incluir_Classe_Erros($campo) {
        	if (!empty(self::$enderecos_campos)) {
	            switch ($campo) {
	                case "cidade":
	                	if (isset(self::$enderecos_campos['erro_cidade'])) {
		                    if (self::$enderecos_campos['erro_cidade'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$enderecos_campos['erro_cidade'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "numero":
	                	if (isset(self::$enderecos_campos['erro_numero'])) {
		                    if (self::$enderecos_campos['erro_numero'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$enderecos_campos['erro_numero'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "estado":
	                	if (isset(self::$enderecos_campos['erro_estado'])) {
		                    if (self::$enderecos_campos['erro_estado'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$enderecos_campos['erro_estado'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "cep":
	                	if (isset(self::$enderecos_campos['erro_cep'])) {
		                    if (self::$enderecos_campos['erro_cep'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$enderecos_campos['erro_cep'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "bairro":
	                	if (isset(self::$enderecos_campos['erro_bairro'])) {
		                    if (self::$enderecos_campos['erro_bairro'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$enderecos_campos['erro_bairro'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                	
	                    break;
	                    
	                case "complemento":
	                	if (isset(self::$enderecos_campos['erro_complemento'])) {
		                    if (self::$enderecos_campos['erro_complemento'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$enderecos_campos['erro_complemento'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "rua":
	                	if (isset(self::$enderecos_campos['erro_rua'])) {
		                    if (self::$enderecos_campos['erro_rua'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$enderecos_campos['erro_rua'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	            }
			}
		}

        public static function Pegar_Valor($campo) {
        	if ($campo == "numero") {
                echo self::$enderecos_form->get_numero();
            } else if ($campo == "cep") {
                echo self::$enderecos_form->get_cep();
            } else if ($campo == "bairro") {
                echo self::$enderecos_form->get_bairro();
            } else if ($campo == "complemento") {
                echo self::$enderecos_form->get_complemento();
            } else if ($campo == "rua") {
                echo self::$enderecos_form->get_rua();
            }
        }
		
        public static function Mostrar_Estados() {
        	$estados = Controller_Enderecos::Buscar_Estados();
        
        	if (!empty($estados) AND $estados !== false) {
        		if (!empty(self::$enderecos_form)) {
        			foreach ($estados as $estado) {
        				if (self::$enderecos_form->get_estado()->get_id() == $estado->get_id()) {
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
        
        public static function Mostrar_Cidades($estado = null) {
        	$id_estado = null;
        
        	if (!empty($estado)) {
        		$id_estado = $estado;
        	} else if (!empty(self::$enderecos_form)) {
        		$id_estado = self::$enderecos_form->get_estado()->get_id();
        	}
        		
        	echo '<option value="0">Selecione sua Cidade</option>';
        		
        	if (!empty($id_estado)) {
        		$cidades = Controller_Enderecos::Buscar_Cidades_Por_Estado($id_estado);
        
        		if (!empty($cidades) AND $cidades !== false) {
        			if (!empty(self::$enderecos_form)) {
        				foreach ($cidades as $cidade) {
        					if (self::$enderecos_form->get_cidade()->get_id() == $cidade->get_id()) {
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
		
        public static function Mostrar_Erros() {
			if (!empty(self::$enderecos_erros)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$enderecos_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                }
                echo "</div></div>";
            }
        }
		
        public static function Mostrar_Sucesso() {
			if (!empty(self::$enderecos_sucesso)) {
				echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$enderecos_sucesso as $value) {
                	echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong><span class=\"glyphicon glyphicon-ok\"></span></strong> " . $value . "</div>";
				}
				echo "</div></div>";
            }
        }
	}
?>