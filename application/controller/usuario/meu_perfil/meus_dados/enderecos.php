<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

	require_once RAIZ.'/application/model/object/endereco.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/enderecos.php';
    require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
	
	use application\model\object\Endereco as Object_Endereco;
	use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Cidade as DAO_Cidade;
    use application\model\dao\Estado as DAO_Estado;
    use application\view\src\usuario\meu_perfil\meus_dados\Enderecos as View_Enderecos;
    use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;

    @session_start();

    class Enderecos {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			new View_Enderecos($status);
        			
        			unset($_SESSION['endereco']);
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public static function Retornar_Cidades_Por_Estado() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
	        	if (isset($_GET['estado'])) {
	        		View_Enderecos::Mostrar_Cidades($_GET['estado']);
	        	}
        	} else {
        		return false;
        	}
        }
		
        public static function Atualizar_Endereco() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		            $erros_enderecos = array();
		            $enderecos_campos = array('erro_cidade' => "certo", 'erro_estado' => "certo", 'erro_numero' => "certo", 'erro_cep' => "certo", 'erro_bairro' => "certo", 'erro_rua' => "certo");
		            
		            $endereco = new Object_Endereco();
		            
		            if (!empty($_POST['complemento'])) {
		            	$complemento = strip_tags($_POST['complemento']);
		            	 
		            	if ($complemento === $_POST['complemento']) {
		            		$complemento = trim($complemento);
		            		$complemento = preg_replace('/\s+/', " ", $complemento);
		            		 
		            		if (strlen($complemento) <= 150) {
		            			$endereco->set_complemento(ucfirst(strtolower($complemento)));
		            		} else {
		            			$erros_enderecos[] = "Complemento, Não pode conter mais de 150 Caracteres";
		            			$enderecos_campos['erro_complemento'] = "erro";
		            		}
		            	} else {
		            		$erros_enderecos[] = "Complemento, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_complemento'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['rua'])) {
		            	$erros_enderecos[] = "Informe sua Rua";
		            	$enderecos_campos['erro_rua'] = "erro";
		            } else {
		            	$rua = strip_tags($_POST['rua']);
		            
		            	if ($rua === $_POST['rua']) {
		            		$rua = trim($rua);
		            		$rua = preg_replace('/\s+/', " ", $rua);
		            		 
		            		if (strlen($rua) <= 150) {
		            			$endereco->set_rua(ucwords(strtolower($rua)));
		            		} else {
		            			$erros_enderecos[] = "Rua, Não pode conter mais de 150 Caracteres";
		            			$enderecos_campos['erro_rua'] = "erro";
		            		}
		            	} else {
		            		$erros_enderecos[] = "Rua, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_rua'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['bairro'])) {
		            	$erros_enderecos[] = "Informe seu Bairro";
		            	$enderecos_campos['erro_bairro'] = "erro";
		            } else {
		            	$bairro = strip_tags($_POST['bairro']);
		            	 
		            	if ($bairro === $_POST['bairro']) {
		            		$bairro = trim($bairro);
		            		$bairro = preg_replace('/\s+/', " ", $bairro);
		            
		            		if (strlen($bairro) <= 45) {
		            			$endereco->set_bairro(ucwords(strtolower($bairro)));
		            		} else {
		            			$erros_enderecos[] = "Bairro, Não pode conter mais de 45 Caracteres";
		            			$enderecos_campos['erro_bairro'] = "erro";
		            		}
		            	} else {
		            		$erros_enderecos[] = "Bairro, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_bairro'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cep'])) {
		            	$erros_enderecos[] = "Informe seu CEP";
		            	$enderecos_campos['erro_cep'] = "erro";
		            } else {
		            	if (strlen($_POST['cep']) === 8) {
		            		if (filter_var($_POST['cep'], FILTER_VALIDATE_INT)) {
		            			$endereco->set_cep($_POST['cep']);
		            		} else {
		            			$erros_enderecos[] = "CEP, Digite Apenas os Numeros";
		            			$enderecos_campos['erro_cep'] = "erro";
		            		}
		            	} else {
		            		$erros_enderecos[] = "CEP Deve conter 8 Numeros";
		            		$enderecos_campos['erro_cep'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['numero'])) {
		            	$erros_enderecos[] = "Informe o Numero do seu Endereço";
		            	$enderecos_campos['erro_numero'] = "erro";
		            } else {
		            	$numero = strip_tags($_POST['numero']);
		            	 
		            	if ($numero === $_POST['numero']) {
		            		$numero = trim($numero);
		            
		            		if (strlen($numero) <= 10) {
		            			$endereco->set_numero($numero);
		            		} else {
		            			$erros_enderecos[] = "Numero do Estabelecimento, Não pode conter mais de 10 Caracteres";
		            			$enderecos_campos['erro_numero'] = "erro";
		            		}
		            	} else {
		            		$erros_enderecos[] = "Numero do Estabelecimento, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_numero'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cidade']) OR $_POST['cidade'] <= 0) {
		            	$erros_enderecos[] = "Seleciona sua Cidade";
		            	$enderecos_campos['erro_cidade'] = "erro";
		            } else {
		            	$endereco->set_cidade_id($_POST['cidade']);
		            }
		            
		            if (empty($_POST['estado']) OR $_POST['estado'] <= 0) {
		            	$erros_enderecos[] = "Seleciona seu Estado";
		            	$enderecos_campos['erro_estado'] = "erro";
		            } else {
		            	$endereco->set_estado_id($_POST['estado']);
		            }
		            
		            if (empty($erros_enderecos)) {
		            	$endereco->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            	
		                DAO_Endereco::Atualizar($endereco);
						
						$_SESSION['success_enderecos'][] = "O Endereço do seu Usuario foi Atualizado com Sucesso!";
		            } else {
		                $_SESSION['erros_enderecos'] = $erros_enderecos;
		            }
		            
		            $_SESSION['enderecos_campos'] = $enderecos_campos;
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }

        public static function Pegar_Endereco_Cidade() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_cidade_id() != null) {
                    return $endereco->get_cidade_id();
                }
            } else {                
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_cidade_id() != null){
                    return $endereco->get_cidade_id();
                }
            }
        }

        public static function Pegar_Endereco_Numero() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_numero() != null) {
                    return $endereco->get_numero();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_numero() != null){
                    return $endereco->get_numero();
                }
            }
        }

        public static function Pegar_Endereco_Estado() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_estado_id() != null) {
                    return $endereco->get_estado_id();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_estado_id() != null) {
                     return $endereco->get_estado_id();
                }
            }
        }

        public static function Pegar_Endereco_CEP() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_cep() != null) {
                    return $endereco->get_cep();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_cep() != null){
                    return $endereco->get_cep();
                }
            }
        }

        public static function Pegar_Endereco_Bairro() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_bairro() != null) {
                    return $endereco->get_bairro();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_bairro() != null){
                    return $endereco->get_bairro();
                }
            }
        }

        public static function Pegar_Endereco_Complemento() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_complemento() != null) {
                    return $endereco->get_complemento();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_complemento() != null){
                    return $endereco->get_complemento();
                }
            }
        }

        public static function Pegar_Endereco_Rua() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_rua() != null) {
                    return $endereco->get_rua();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_rua() != null){
                    return $endereco->get_rua();
                }
            }
        }

        private function Pegar_Endereco(Object_Endereco $endereco) {
            $endereco = DAO_Endereco::Buscar_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id());
            
            $_SESSION['endereco'] = $endereco;
            
            return $endereco;
        }
		
		public static function Buscar_Estados() {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidade_Por_Estado($id_estado) {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
		
		public static function Buscar_Cidade_Por_Estado_Usuario() {
			return DAO_Cidade::BuscarPorCOD(self::Pegar_Endereco_Estado());
		}
	}
?>