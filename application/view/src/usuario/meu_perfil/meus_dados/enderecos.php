<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;

	require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
	require_once(RAIZ.'/application/model/object/class_endereco.php');
	require_once(RAIZ.'/application/model/object/class_cidade.php');
	require_once(RAIZ.'/application/model/object/class_estado.php');
	require_once(RAIZ.'/application/model/object/class_usuario.php');
	
	use application\controller\usuario\meu_perfil\meus_dados\Enderecos as Controller_Enderecos;
	use application\model\object\Endereco;
    use application\model\object\Estado;
    use application\model\object\Cidade;
	use application\model\object\Usuario;
    
    @session_start;
	
	new Enderecos();

    class Enderecos {

        function __construct() {
            ob_start();
			
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               	if (isset($_POST['enderecos'])) {
                	$this->Atualizar_Endereco();
				} else {
					self::Mostrar_Cidades();
				}
            }
        }
		
        private function Atualizar_Endereco() {
            $endereco = new Endereco();
            
            $endereco->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $endereco->set_cidade_id($_POST['cidade']);
            $endereco->set_estado_id($_POST['estado']);
            $endereco->set_numero($_POST['numero']);
            $endereco->set_cep($_POST['cep']);
            $endereco->set_rua($_POST['rua']);
            $endereco->set_complemento($_POST['complemento']);
            $endereco->set_bairro($_POST['bairro']);
            
            Controller_Enderecos::Atualizar_Endereco($endereco);
			
            header("location: /usuario/meu-perfil/meus-dados/enderecos/");
        }
		
        public static function Incluir_Classe_Erros($campo) {
        	if (isset($_SESSION['enderecos_campos'])) {
	            $enderecos_campos = $_SESSION['enderecos_campos'];
	            
	            switch ($campo) {
	                case "cidade":
	                	if (isset($enderecos_campos['erro_cidade'])) {
		                    if ($enderecos_campos['erro_cidade'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($enderecos_campos['erro_cidade'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($enderecos_campos['erro_cidade']);
	                	}
	                	
	                    break;
	                    
	                case "numero":
	                	if (isset($enderecos_campos['erro_numero'])) {
		                    if ($enderecos_campos['erro_numero'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($enderecos_campos['erro_numero'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($enderecos_campos['erro_numero']);
	                	}
	                	
	                    break;
	                    
	                case "estado":
	                	if (isset($enderecos_campos['erro_estado'])) {
		                    if ($enderecos_campos['erro_estado'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($enderecos_campos['erro_estado'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($enderecos_campos['erro_estado']);
	                	}
	                	
	                    break;
	                    
	                case "cep":
	                	if (isset($enderecos_campos['erro_cep'])) {
		                    if ($enderecos_campos['erro_cep'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($enderecos_campos['erro_cep'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($enderecos_campos['erro_cep']);
	                	}
	                	
	                    break;
	                    
	                case "bairro":
	                	if (isset($enderecos_campos['erro_bairro'])) {
		                    if ($enderecos_campos['erro_bairro'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($enderecos_campos['erro_bairro'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($enderecos_campos['erro_bairro']);
	                	}
	                	
	                    break;
	                    
	                case "complemento":
	                	if (isset($enderecos_campos['erro_complemento'])) {
		                    if ($enderecos_campos['erro_complemento'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($enderecos_campos['erro_complemento'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($enderecos_campos['erro_complemento']);
	                	}
	                	
	                    break;
	                    
	                case "rua":
	                	if (isset($enderecos_campos['erro_rua'])) {
		                    if ($enderecos_campos['erro_rua'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if ($enderecos_campos['erro_rua'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
		                    unset($enderecos_campos['erro_rua']);
	                	}
	                	
	                    break;
	            }
	            
				if (count($enderecos_campos) > 0) {
	            	$_SESSION['enderecos_campos'] = $enderecos_campos;
        		} else {
        			unset($_SESSION['enderecos_campos']);
        		}
			}
		}

        public static function Pegar_Valor($campo) {                    
        	if ($campo == "numero") {
                echo Controller_Enderecos::Pegar_Endereco_Numero();
            } else if ($campo == "cep") {
                echo Controller_Enderecos::Pegar_Endereco_CEP();
            } else if ($campo == "bairro") {
                echo Controller_Enderecos::Pegar_Endereco_Bairro();
            } else if ($campo == "complemento") {
                echo Controller_Enderecos::Pegar_Endereco_Complemento();
            } else if ($campo == "rua") {
                echo Controller_Enderecos::Pegar_Endereco_Rua();
            }
        }
		
        public static function Mostrar_Estados() {
            $estados = Controller_Enderecos::Buscar_Estados();
            
            foreach ($estados as $estado) {
                if (Controller_Enderecos::Pegar_Endereco_Estado() == $estado->get_id()) {
                    echo "<option selected value=\"". $estado->get_id() . "\">" . $estado->get_uf() . " - " . $estado->get_nome() . "</option>";
                } else {
                    echo "<option value=\"". $estado->get_id() . "\">" . $estado->get_uf() . " - " . $estado->get_nome() . "</option>";
                }
            }
        }
        
        public static function Mostrar_Cidades() {
        	$cidades = array();
        	
            if (isset($_POST['estado'])) {
                $cidades = Controller_Enderecos::Buscar_Cidade_Por_Estado($_POST['estado']);
            } else {
                $cidades = Controller_Enderecos::Buscar_Cidade_Por_Estado_Usuario();
            }
            
			echo "<option value=\"0\">Selecione sua Cidade</option>";
			
            foreach ($cidades as $cidade) {
                if (Controller_Enderecos::Pegar_Endereco_Cidade() == $cidade->get_id()) {
                    echo "<option selected value=\"". $cidade->get_id() . "\">" . $cidade->get_nome() . "</option>";
                } else {
                    echo "<option value=\"". $cidade->get_id() . "\">" . $cidade->get_nome() . "</option>";
                }
            }
        }
		
        public static function Mostrar_Erros() {
			if (isset($_SESSION['erros_enderecos'])) {
                $erros_enderecos = $_SESSION['erros_enderecos'];
                if (isset($erros_enderecos)) {
                    echo "<div class=\"container-fluid\"><div class=\"row\">";
                    foreach ($erros_enderecos as $value) {
                        echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                    }
                    echo "</div></div>";
                }
                unset($_SESSION['erros_enderecos']);
            }
        }
		
        public static function Mostrar_Sucesso() {
			if (isset($_SESSION['success_enderecos'])) {
                $success_enderecos = $_SESSION['success_enderecos'];
				if (isset($success_enderecos)) {
					echo "<div class=\"container-fluid\"><div class=\"row\">";
                	foreach ($success_enderecos as $value) {
                		echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong><span class=\"glyphicon glyphicon-ok\"></span></strong> " . $value . "</div>";
					}
					echo "</div></div>";
				}
                unset($_SESSION['success_enderecos']);
            }
        }
	}
?>