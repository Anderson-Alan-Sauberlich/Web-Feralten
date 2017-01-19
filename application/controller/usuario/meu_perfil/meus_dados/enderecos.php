<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

	require_once RAIZ.'/application/model/object/endereco.php';
	require_once RAIZ.'/application/model/object/cidade.php';
	require_once RAIZ.'/application/model/object/estado.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/enderecos.php';
    require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	
	use application\model\object\Endereco as Object_Endereco;
	use application\model\object\Cidade as Object_Cidade;
	use application\model\object\Estado as Object_Estado;
	use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Cidade as DAO_Cidade;
    use application\model\dao\Estado as DAO_Estado;
    use application\view\src\usuario\meu_perfil\meus_dados\Enderecos as View_Enderecos;
    use application\controller\include_page\menu\Usuario as Controller_Usuario;

    class Enderecos {

        function __construct() {
            
        }
        
        public function Carregar_Pagina($enderecos_erros= null, $enderecos_campos = null, $enderecos_sucesso= null, $enderecos_form = null) {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			$view = new View_Enderecos($status);
        			
        			$view->set_enderecos_campos($enderecos_campos);
        			$view->set_enderecos_erros($enderecos_erros);
        			$view->set_enderecos_sucesso($enderecos_sucesso);
        			
        			if (!empty($enderecos_form)) {
        				$view->set_enderecos_form($enderecos_form);
        			} else {
        				$view->set_enderecos_form(DAO_Endereco::Buscar_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id()));
        			}
        			 
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public function Retornar_Cidades_Por_Estado() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
	        	if (isset($_GET['estado'])) {
	        		View_Enderecos::Mostrar_Cidades($_GET['estado']);
	        	}
        	} else {
        		return false;
        	}
        }
		
        public function Atualizar_Endereco() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		            $enderecos_erros = array();
		            $enderecos_sucesso = array();
		            $enderecos_form = null;
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
		            			$enderecos_erros[] = "Complemento, Não pode conter mais de 150 Caracteres";
		            			$enderecos_campos['erro_complemento'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "Complemento, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_complemento'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['rua'])) {
		            	$enderecos_erros[] = "Informe sua Rua";
		            	$enderecos_campos['erro_rua'] = "erro";
		            } else {
		            	$rua = strip_tags($_POST['rua']);
		            
		            	if ($rua === $_POST['rua']) {
		            		$rua = trim($rua);
		            		$rua = preg_replace('/\s+/', " ", $rua);
		            		 
		            		if (strlen($rua) <= 150) {
		            			$endereco->set_rua(ucwords(strtolower($rua)));
		            		} else {
		            			$enderecos_erros[] = "Rua, Não pode conter mais de 150 Caracteres";
		            			$enderecos_campos['erro_rua'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "Rua, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_rua'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['bairro'])) {
		            	$enderecos_erros[] = "Informe seu Bairro";
		            	$enderecos_campos['erro_bairro'] = "erro";
		            } else {
		            	$bairro = strip_tags($_POST['bairro']);
		            	 
		            	if ($bairro === $_POST['bairro']) {
		            		$bairro = trim($bairro);
		            		$bairro = preg_replace('/\s+/', " ", $bairro);
		            
		            		if (strlen($bairro) <= 45) {
		            			$endereco->set_bairro(ucwords(strtolower($bairro)));
		            		} else {
		            			$enderecos_erros[] = "Bairro, Não pode conter mais de 45 Caracteres";
		            			$enderecos_campos['erro_bairro'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "Bairro, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_bairro'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cep'])) {
		            	$enderecos_erros[] = "Informe seu CEP";
		            	$enderecos_campos['erro_cep'] = "erro";
		            } else {
		            	if (strlen($_POST['cep']) === 8) {
		            		if (filter_var($_POST['cep'], FILTER_VALIDATE_INT)) {
		            			$endereco->set_cep($_POST['cep']);
		            		} else {
		            			$enderecos_erros[] = "CEP, Digite Apenas os Numeros";
		            			$enderecos_campos['erro_cep'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "CEP Deve conter 8 Numeros";
		            		$enderecos_campos['erro_cep'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['numero'])) {
		            	$enderecos_erros[] = "Informe o Numero do seu Endereço";
		            	$enderecos_campos['erro_numero'] = "erro";
		            } else {
		            	$numero = strip_tags($_POST['numero']);
		            	 
		            	if ($numero === $_POST['numero']) {
		            		$numero = trim($numero);
		            
		            		if (strlen($numero) <= 10) {
		            			$endereco->set_numero($numero);
		            		} else {
		            			$enderecos_erros[] = "Numero do Estabelecimento, Não pode conter mais de 10 Caracteres";
		            			$enderecos_campos['erro_numero'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "Numero do Estabelecimento, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_numero'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cidade']) OR $_POST['cidade'] <= 0) {
		            	$enderecos_erros[] = "Seleciona sua Cidade";
		            	$enderecos_campos['erro_cidade'] = "erro";
		            } else {
		            	$cidade = new Object_Cidade();
		            	
		            	$cidade->set_id($_POST['cidade']);
		            	
		            	$endereco->set_cidade($cidade);
		            }
		            
		            if (empty($_POST['estado']) OR $_POST['estado'] <= 0) {
		            	$enderecos_erros[] = "Seleciona seu Estado";
		            	$enderecos_campos['erro_estado'] = "erro";
		            } else {
		            	$estado = new Object_Estado();
		            	
		            	$estado->set_id($_POST['estado']);
		            	
		            	$endereco->set_estado($estado);
		            }
		            
		            if (empty($enderecos_erros)) {
		            	$endereco->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            	
		                if (DAO_Endereco::Atualizar($endereco) === false) {
		                	$enderecos_erros[] = "Erro ao tentar Atualizar Endereço";
		                } else {
		                	$enderecos_sucesso[] = "O Endereço do seu Usuario foi Atualizado com Sucesso!";
		                	$enderecos_form = $endereco;
		                }
		            }
		            
					$this->Carregar_Pagina($enderecos_erros, $enderecos_campos, $enderecos_sucesso, $enderecos_form);
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
		
		public static function Buscar_Estados() {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidades_Por_Estado($id_estado) {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
	}
?>