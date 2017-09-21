<?php
namespace module\application\controller\usuario\meu_perfil\meus_dados;
	
	use module\application\model\common\util\Validador;
	use module\application\model\common\util\Login_Session;
	use module\application\model\common\util\Gerenciar_Imagens;
	use module\application\model\object\Usuario as Object_Usuario;
    use module\application\model\object\Entidade as Object_Entidade;
    use module\application\model\object\Endereco as Object_Endereco;
    use module\application\model\object\Cidade as Object_Cidade;
    use module\application\model\object\Estado as Object_Estado;
    use module\application\model\dao\Usuario as DAO_Usuario;
	use module\application\model\dao\Entidade as DAO_Entidade;
	use module\application\model\dao\Endereco as DAO_Endereco;
    use module\application\model\dao\Estado as DAO_Estado;
    use module\application\model\dao\Cidade as DAO_Cidade;
	use module\application\view\src\usuario\meu_perfil\meus_dados\Concluir as View_Concluir;
	use module\application\controller\layout\menu\Usuario as Controller_Usuario;
	use module\application\controller\usuario\Login as Controller_Login;
    use \Exception;
	
    class Concluir {
		
        function __construct() {
            
        }
        
        private $fone;
        private $fone_alternativo;
        private $email_alternativo;
        private $estado;
        private $cidade;
        private $numero;
        private $cep;
        private $bairro;
        private $rua;
        private $complemento;
        private $cpf_cnpj;
        private $site;
        private $nome_comercial;
        private $concluir_erros = array();
        private $concluir_campos = array();
        private $concluir_form = array();
        
        public function set_fone($fone) {
        	try {
        		$this->fone = Validador::Usuario()::validar_fone($fone);
        		$this->concluir_campos['erro_fone'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_fone'] = 'erro';
        		
        		$this->fone = Validador::Usuario()::filtrar_fone($fone);
        	}
        }
        
        public function set_fone_alternativo($fone_alternativo = null) {
        	try {
        		$this->fone_alternativo = Validador::Usuario()::validar_fone_alternativo($fone_alternativo);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_fone_alternativo'] = 'erro';
        		
        		$this->fone_alternativo = Validador::Usuario()::filtrar_fone_alternativo($fone_alternativo);
        	}
        }
        
        public function set_email_alternativo($email_alternativo = null) {
        	try {
        		$this->email_alternativo = Validador::Usuario()::validar_email_alternativo($email_alternativo);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_email_alternativo'] = 'erro';
        		
        		$this->email_alternativo = Validador::Usuario()::filtrar_email_alternativo($email_alternativo);
        	}
        }
        
        public function set_estado($estado) {
        	try {
        		$this->estado = Validador::Estado()::validar_id($estado);
        		$this->concluir_campos['erro_estado'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_estado'] = 'erro';
        		
        		$this->estado = Validador::Estado()::filtrar_id($estado);
        	}
        }
        
        public function set_cidade($cidade) {
        	try {
        		$this->cidade = Validador::Cidade()::validar_id($cidade);
        		$this->concluir_campos['erro_cidade'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_cidade'] = 'erro';
        		
        		$this->cidade = Validador::Cidade()::filtrar_id($cidade);
        	}
        }
        
        public function set_numero($numero) {
        	try {
        		$this->numero = Validador::Endereco()::validar_numero($numero);
        		$this->concluir_campos['erro_numero'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_numero'] = 'erro';
        		
        		$this->numero = Validador::Endereco()::filtrar_numero($numero);
        	}
        }
        
        public function set_cep($cep) {
        	try {
        		$this->cep = Validador::Endereco()::validar_cep($cep);
        		$this->concluir_campos['erro_cep'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_cep'] = 'erro';
        		
        		$this->cep = Validador::Endereco()::filtrar_cep($cep);
        	}
        }
        
        public function set_bairro($bairro) {
        	try {
        		$this->bairro = Validador::Endereco()::validar_bairro($bairro);
        		$this->concluir_campos['erro_bairro'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_bairro'] = 'erro';
        		
        		$this->bairro = Validador::Endereco()::filtrar_bairro($bairro);
        	}
        }
        
        public function set_rua($rua) {
        	try {
        		$this->rua = Validador::Endereco()::validar_rua($rua);
        		$this->concluir_campos['erro_rua'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_rua'] = 'erro';
        		
        		$this->rua = Validador::Endereco()::filtrar_rua($rua);
        	}
        }
        
        public function set_complemento($complemento = null) {
        	try {
        		$this->complemento = Validador::Endereco()::validar_complemento($complemento);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_complemento'] = 'erro';
        		
        		$this->complemento = Validador::Endereco()::filtrar_complemento($complemento);
        	}
        }
        
        public function set_cpf_cnpj($cpf_cnpj) {
        	try {
        		$this->cpf_cnpj = Validador::Entidade()::validar_cpf_cnpj($cpf_cnpj);
        		$this->concluir_campos['erro_cpf_cnpj'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_cpf_cnpj'] = 'erro';
        		
        		$this->cpf_cnpj = Validador::Entidade()::filtrar_cpf_cnpj($cpf_cnpj);
        	}
        }
        
        public function set_site($site = null) {
        	try {
        		$this->site = Validador::Entidade()::validar_site($site);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_site'] = 'erro';
        		
        		$this->site = Validador::Entidade()::filtrar_site($site);
        	}
        }
        
        public function set_nome_comercial($nome_comercial = null) {
        	try {
        		$this->nome_comercial = Validador::Entidade()::validar_nome_comercial($nome_comercial);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_nome_comercial'] = 'erro';
        		
        		$this->nome_comercial = Validador::Entidade()::filtrar_nome_comercial($nome_comercial);
        	}
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
        			$view = new View_Concluir($status);
        			
        			$view->set_concluir_campos($this->concluir_campos);
        			$view->set_concluir_erros($this->concluir_erros);
        			$view->set_concluir_form($this->concluir_form);
        			 
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public function Concluir_Cadastro() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
		            if (empty($this->concluir_erros)) {
		            	$usuario = new Object_Usuario();
		            	$usuario->set_fone($this->fone);
		            	$usuario->set_fone_alternativo($this->fone_alternativo);
		            	$usuario->set_email_alternativo($this->email_alternativo);
		            	$usuario->set_id(Login_Session::get_usuario_id());
		            	
		            	if (DAO_Usuario::Atualizar_Contato($usuario) !== false) {
		            		$entidade = new Object_Entidade();
		            		$entidade->set_usuario_id(Login_Session::get_usuario_id());
		            		$entidade->set_status_id(1);
		            		$entidade->set_data(date('Y-m-d H:i:s'));
		            		$entidade->set_cpf_cnpj($this->cpf_cnpj);
		            		$entidade->set_site($this->site);
		            		$entidade->set_nome_comercial($this->nome_comercial);
		            		
		            		$id_entidade = DAO_Entidade::Inserir($entidade);
		            		
		            		if ($id_entidade != false) {
		            			Login_Session::set_entidade_id($id_entidade);
			                	
			                	$imagem = $this->Salvar_Imagem();
			                	
			                	if (!empty($imagem)) {
			                		DAO_Entidade::Atualizar_Imagem($imagem, $id_entidade);
			                	}
			                	
			                	$object_estado = new Object_Estado();
			                	$object_estado->set_id($this->estado);
			                	
			                	$object_cidade = new Object_Cidade();
			                	$object_cidade->set_id($this->cidade);
			                	
			                	$endereco = new Object_Endereco();
			                	$endereco->set_id(0);
			                	$endereco->set_entidade_id($id_entidade);
			                	$endereco->set_cidade($object_cidade);
			                	$endereco->set_estado($object_estado);
			                	$endereco->set_numero($this->numero);
			                	$endereco->set_cep($this->cep);
			                	$endereco->set_bairro($this->bairro);
			                	$endereco->set_rua($this->rua);
			                	$endereco->set_complemento($this->complemento);
			                	
			                	if (DAO_Endereco::Inserir($endereco) === false) {
			                		$this->concluir_erros[] = "Erro ao tentar Inserir Endereço do Usuario";
			                	}
			            	} else {
			            		$this->concluir_erros[] = "Erro ao tentar Inserir Dados do Usuario";
			            	}
		            	} else {
		            		$this->concluir_erros[] = "Erro ao tentar Inserir Dados do Usuario";
		            	}
		            }
		            
		            if (empty($this->concluir_erros)) {
		            	Controller_Login::ReAutenticar_Usuario_Logado(Login_Session::get_usuario_id());
		            	
		            	return 'certo';
		            } else {
		            	$this->concluir_form['fone'] = $this->fone;
		            	$this->concluir_form['fone_alternativo'] = $this->fone_alternativo;
		            	$this->concluir_form['cidade'] = $this->cidade;
		            	$this->concluir_form['estado'] = $this->estado;
		            	$this->concluir_form['numero'] = $this->numero;
		            	$this->concluir_form['cep'] = $this->cep;
		            	$this->concluir_form['rua'] = $this->rua;
		            	$this->concluir_form['complemento'] = $this->complemento;
		            	$this->concluir_form['bairro'] = $this->bairro;
		            	$this->concluir_form['cpf_cnpj'] = $this->cpf_cnpj;
		            	$this->concluir_form['nome_comercial'] = $this->nome_comercial;
		            	$this->concluir_form['email_alternativo'] = $this->email_alternativo;
		            	$this->concluir_form['site'] = $this->site;
		            	
		            	$this->Carregar_Pagina();
		            }
        		} else {
        			return $status;
        		}
        	} else {
        		return false;
        	}
        }
        
        public function Retornar_Cidades_Por_Estado() : void {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
	        	if (!empty($this->estado)) {
	        		if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
	        			View_Concluir::Mostrar_Cidades($this->estado);
	        		}
	        	}
        	}
        }
        
		public function Salvar_Imagem_TMP() : void {
			if (Controller_Usuario::Verificar_Autenticacao()) {
				if (isset($_FILES['imagem']) AND $_FILES['imagem']['error'] === 0) {
					$imagens = new Gerenciar_Imagens();
						
					$imagens->Armazenar_Imagem_Temporaria($_FILES['imagem']);
						
					$_SESSION['imagem_tmp'] = $imagens->get_nome();
						
					echo $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
				} else {
					echo "/resources/img/imagem_indisponivel.png";
				}
			}
		}
		
		public function Deletar_Imagem() : void {
			if (Controller_Usuario::Verificar_Autenticacao()) {
				if (isset($_SESSION['imagem_tmp'])) {
					$imagens = new Gerenciar_Imagens();
					
					$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
					
					unset($_SESSION['imagem_tmp']);
				}
			}
		}
		
		public static function Pegar_Imagem_URL(?string $nome_imagem = null) : string {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-200x150");
			
			if (isset($caminho_imagem)) {
				return $imagens::Gerar_Data_URL($caminho_imagem);
			} else {
				return "/resources/img/imagem_indisponivel.png";
			}
		}

        private function Salvar_Imagem() : ?string {
        	if (isset($_SESSION['imagem_tmp']) AND !empty($_SESSION['imagem_tmp'])) {
        		$img_nome = null;
        		$imagens = new Gerenciar_Imagens();
        		
        		if (!empty($this->nome_comercial)) {
        			$img_nome = $imagens->Arquivar_Imagem_Entidade($_SESSION['imagem_tmp'], Validador::Entidade()::filtrar_descricao_imagem($this->nome_comercial));
        		} else {
        			$img_nome = $imagens->Arquivar_Imagem_Entidade($_SESSION['imagem_tmp']);
        		}
        		
        		unset($_SESSION['imagem_tmp']);
        		
        		if (!empty($img_nome)) {
        			return $img_nome;
        		} else {
        			return null;
        		}
			} else {
				return null;
			}
        }
        
		public static function Buscar_Todos_Estados() : array {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidades_Por_Estado(?int $id_estado = null) : array {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
    }
?>