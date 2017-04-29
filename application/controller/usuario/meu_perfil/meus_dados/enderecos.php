<?php
namespace application\controller\usuario\meu_perfil\meus_dados;
	
	require_once RAIZ.'/application/model/common/util/login_session.php';
	require_once RAIZ.'/application/model/object/endereco.php';
	require_once RAIZ.'/application/model/object/cidade.php';
	require_once RAIZ.'/application/model/object/estado.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/enderecos.php';
    require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	
    use application\model\common\util\Login_Session;
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
        
        private $estado;
        private $cidade;
        private $numero;
        private $cep;
        private $bairro;
        private $rua;
        private $complemento;
        
        public function set_estado($estado) {
        	$this->estado = $estado;
        }
        
        public function set_cidade($cidade) {
        	$this->cidade = $cidade;
        }
        
        public function set_numero($numero) {
        	$this->numero = $numero;
        }
        
        public function set_cep($cep) {
        	$this->cep = $cep;
        }
        
        public function set_bairro($bairro) {
        	$this->bairro = $bairro;
        }
        
        public function set_rua($rua) {
        	$this->rua = $rua;
        }
        
        public function set_complemento($complemento = null) {
        	$this->complemento = $complemento;
        }
        
        public function Carregar_Pagina(?array $enderecos_erros = null, ?array $enderecos_campos = null, ?array $enderecos_sucesso = null, ?Object_Endereco $enderecos_form = null) {
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
        				$endereco_retorno = DAO_Endereco::Buscar_Por_Id_Entidade(Login_Session::get_entidade_id());
        				
        				if (!empty($endereco_retorno) AND $endereco_retorno != false) {
        					$view->set_enderecos_form($endereco_retorno);
        				} else {
        					$view->set_enderecos_form(new Object_Endereco());
        				}
        			}
        			 
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public function Retornar_Cidades_Por_Estado() : void {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		if (!empty($this->estado)) {
        			if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
        				View_Enderecos::Mostrar_Cidades($this->estado);
        			}
        		}
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
		            
		            if (!empty($this->complemento)) {
		            	$complemento = strip_tags($this->complemento);
		            	 
		            	if ($complemento === $this->complemento) {
		            		$this->complemento = trim($this->complemento);
		            		$this->complemento = preg_replace('/\s+/', " ", $this->complemento);
		            		 
		            		if (strlen($this->complemento) <= 150) {
		            			$endereco->set_complemento(ucfirst(strtolower($this->complemento)));
		            		} else {
		            			$enderecos_erros[] = "Complemento, Não pode conter mais de 150 Caracteres";
		            			$enderecos_campos['erro_complemento'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "Complemento, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_complemento'] = "erro";
		            	}
		            }
		            
		            if (empty($this->rua)) {
		            	$enderecos_erros[] = "Informe sua Rua";
		            	$enderecos_campos['erro_rua'] = "erro";
		            } else {
		            	$rua = strip_tags($this->rua);
		            
		            	if ($rua === $this->rua) {
		            		$this->rua = trim($this->rua);
		            		$this->rua = preg_replace('/\s+/', " ", $this->rua);
		            		 
		            		if (strlen($this->rua) <= 150) {
		            			$endereco->set_rua(ucwords(strtolower($this->rua)));
		            		} else {
		            			$enderecos_erros[] = "Rua, Não pode conter mais de 150 Caracteres";
		            			$enderecos_campos['erro_rua'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "Rua, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_rua'] = "erro";
		            	}
		            }
		            
		            if (empty($this->bairro)) {
		            	$enderecos_erros[] = "Informe seu Bairro";
		            	$enderecos_campos['erro_bairro'] = "erro";
		            } else {
		            	$bairro = strip_tags($this->bairro);
		            	 
		            	if ($bairro === $this->bairro) {
		            		$this->bairro = trim($this->bairro);
		            		$this->bairro = preg_replace('/\s+/', " ", $this->bairro);
		            
		            		if (strlen($this->bairro) <= 150) {
		            			$endereco->set_bairro(ucwords(strtolower($this->bairro)));
		            		} else {
		            			$enderecos_erros[] = "Bairro, Não pode conter mais de 150 Caracteres";
		            			$enderecos_campos['erro_bairro'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "Bairro, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_bairro'] = "erro";
		            	}
		            }
		            
		            if (empty($this->cep)) {
		            	$enderecos_erros[] = "Informe seu CEP";
		            	$enderecos_campos['erro_cep'] = "erro";
		            } else {
		            	$this->cep = trim($this->cep);
		            	$this->cep = preg_replace('/[^a-zA-Z0-9]/', "", $this->cep);
		            	
		            	if (strlen($this->cep) === 8) {
		            		if (filter_var($this->cep, FILTER_VALIDATE_INT)) {
		            			$endereco->set_cep($this->cep);
		            		} else {
		            			$enderecos_erros[] = "CEP, Digite Apenas os Numeros";
		            			$enderecos_campos['erro_cep'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "CEP Deve conter 8 Numeros";
		            		$enderecos_campos['erro_cep'] = "erro";
		            	}
		            }
		            
		            if (empty($this->numero)) {
		            	$enderecos_erros[] = "Informe o Numero do seu Endereço";
		            	$enderecos_campos['erro_numero'] = "erro";
		            } else {
		            	$numero = strip_tags($this->numero);
		            	 
		            	if ($numero === $this->numero) {
		            		$this->numero = trim($this->numero);
		            
		            		if (strlen($this->numero) <= 10) {
		            			$endereco->set_numero($this->numero);
		            		} else {
		            			$enderecos_erros[] = "Numero do Estabelecimento, Não pode conter mais de 10 Caracteres";
		            			$enderecos_campos['erro_numero'] = "erro";
		            		}
		            	} else {
		            		$enderecos_erros[] = "Numero do Estabelecimento, Não pode conter Tags de Programação";
		            		$enderecos_campos['erro_numero'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['cidade'])) {
		            	$enderecos_erros[] = "Selecione sua Cidade";
		            	$enderecos_campos['erro_cidade'] = "erro";
		            } else {
		            	if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
			            	$cidade = new Object_Cidade();
			            	
			            	$cidade->set_id($_POST['cidade']);
			            	
			            	$endereco->set_cidade($cidade);
		            	} else {
		            		$enderecos_erros[] = "Selecione uma Cidade Válida";
		            		$enderecos_campos['erro_cidade'] = "erro";
		            	}
		            }
		            
		            if (empty($_POST['estado'])) {
		            	$enderecos_erros[] = "Selecione seu Estado";
		            	$enderecos_campos['erro_estado'] = "erro";
		            } else {
		            	if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
			            	$estado = new Object_Estado();
			            	
			            	$estado->set_id($_POST['estado']);
			            	
			            	$endereco->set_estado($estado);
		            	} else {
		            		$enderecos_erros[] = "Selecione um Estado Válido";
		            		$enderecos_campos['erro_estado'] = "erro";
		            	}
		            }
		            
		            if (empty($enderecos_erros)) {
		            	$endereco->set_entidade_id(Login_Session::get_entidade_id());
		            	
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
		
		public static function Buscar_Estados() : array {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidades_Por_Estado(?int $id_estado = null) : array {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
	}
?>