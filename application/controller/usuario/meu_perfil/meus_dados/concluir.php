<?php
namespace application\controller\usuario\meu_perfil\meus_dados;
	
	require_once RAIZ.'/application/model/common/util/filtro.php';
	require_once RAIZ.'/application/model/common/util/login_session.php';
	require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/model/object/entidade.php';
    require_once RAIZ.'/application/model/object/endereco.php';
    require_once RAIZ.'/application/model/object/cidade.php';
    require_once RAIZ.'/application/model/object/estado.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/dao/entidade.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
	require_once RAIZ.'/application/model/common/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/concluir.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	require_once RAIZ.'/application/controller/usuario/login.php';
    
	use application\model\common\util\Filtro;
	use application\model\common\util\Login_Session;
	use application\model\common\util\Gerenciar_Imagens;
	use application\model\object\usuario as Object_Usuario;
    use application\model\object\Entidade as Object_Entidade;
    use application\model\object\Endereco as Object_Endereco;
    use application\model\object\Cidade as Object_Cidade;
    use application\model\object\Estado as Object_Estado;
    use application\model\dao\Usuario as DAO_Usuario;
	use application\model\dao\Entidade as DAO_Entidade;
	use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Estado as DAO_Estado;
    use application\model\dao\Cidade as DAO_Cidade;
	use application\view\src\usuario\meu_perfil\meus_dados\Concluir as View_Concluir;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	use application\controller\usuario\Login as Controller_Login;
    use \Exception;
	
    class Concluir {
		
        function __construct() {
            
        }
        
        private $fone1;
        private $fone2;
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
        
        public function set_fone1($fone1) {
        	try {
        		$this->fone1 = Filtro::Usuario()::validar_fone1($fone1);
        		$this->concluir_campos['erro_fone1'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_fone1'] = 'erro';
        		
        		$this->fone1 = Filtro::Usuario()::filtrar_fone1($fone1);
        	}
        }
        
        public function set_fone2($fone2 = null) {
        	try {
        		$this->fone2 = Filtro::Usuario()::validar_fone2($fone2);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_fone2'] = 'erro';
        		
        		$this->fone2 = Filtro::Usuario()::filtrar_fone2($fone2);
        	}
        }
        
        public function set_email_alternativo($email_alternativo = null) {
        	try {
        		$this->email_alternativo = Filtro::Usuario()::validar_email_alternativo($email_alternativo);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_email_alternativo'] = 'erro';
        		
        		$this->email_alternativo = Filtro::Usuario()::filtrar_email_alternativo($email_alternativo);
        	}
        }
        
        public function set_estado($estado) {
        	try {
        		$this->estado = Filtro::Estado()::validar_id($estado);
        		$this->concluir_campos['erro_estado'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_estado'] = 'erro';
        		
        		$this->estado = Filtro::Estado()::filtrar_id($estado);
        	}
        }
        
        public function set_cidade($cidade) {
        	try {
        		$this->cidade = Filtro::Cidade()::validar_id($cidade);
        		$this->concluir_campos['erro_cidade'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_cidade'] = 'erro';
        		
        		$this->cidade = Filtro::Cidade()::filtrar_id($cidade);
        	}
        }
        
        public function set_numero($numero) {
        	try {
        		$this->numero = Filtro::Endereco()::validar_numero($numero);
        		$this->concluir_campos['erro_numero'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_numero'] = 'erro';
        		
        		$this->numero = Filtro::Endereco()::filtrar_numero($numero);
        	}
        }
        
        public function set_cep($cep) {
        	try {
        		$this->cep = Filtro::Endereco()::validar_cep($cep);
        		$this->concluir_campos['erro_cep'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_cep'] = 'erro';
        		
        		$this->cep = Filtro::Endereco()::filtrar_cep($cep);
        	}
        }
        
        public function set_bairro($bairro) {
        	try {
        		$this->bairro = Filtro::Endereco()::validar_bairro($bairro);
        		$this->concluir_campos['erro_bairro'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_bairro'] = 'erro';
        		
        		$this->bairro = Filtro::Endereco()::filtrar_bairro($bairro);
        	}
        }
        
        public function set_rua($rua) {
        	try {
        		$this->rua = Filtro::Endereco()::validar_rua($rua);
        		$this->concluir_campos['erro_rua'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_rua'] = 'erro';
        		
        		$this->rua = Filtro::Endereco()::filtrar_rua($rua);
        	}
        }
        
        public function set_complemento($complemento = null) {
        	try {
        		$this->complemento = Filtro::Endereco()::validar_complemento($complemento);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_complemento'] = 'erro';
        		
        		$this->complemento = Filtro::Endereco()::filtrar_complemento($complemento);
        	}
        }
        
        public function set_cpf_cnpj($cpf_cnpj) {
        	try {
        		$this->cpf_cnpj = Filtro::Entidade()::validar_cpf_cnpj($cpf_cnpj);
        		$this->concluir_campos['erro_cpf_cnpj'] = 'certo';
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_cpf_cnpj'] = 'erro';
        		
        		$this->cpf_cnpj = Filtro::Entidade()::filtrar_cpf_cnpj($cpf_cnpj);
        	}
        }
        
        public function set_site($site = null) {
        	try {
        		$this->site = Filtro::Entidade()::validar_site($site);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_site'] = 'erro';
        		
        		$this->site = Filtro::Entidade()::filtrar_site($site);
        	}
        }
        
        public function set_nome_comercial($nome_comercial = null) {
        	try {
        		$this->nome_comercial = Filtro::Entidade()::validar_nome_comercial($nome_comercial);
        	} catch (Exception $e) {
        		$this->concluir_erros[] = $e->getMessage();
        		$this->concluir_campos['erro_nome_comercial'] = 'erro';
        		
        		$this->nome_comercial = Filtro::Entidade()::filtrar_nome_comercial($nome_comercial);
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
		            	$entidade = new Object_Entidade();
		            	$endereco = new Object_Endereco();
		            	$object_cidade = new Object_Cidade();
		            	$object_estado = new Object_Estado();
		            	
		            	$object_estado->set_id($this->estado);
		            	
		            	$object_cidade->set_id($this->cidade);
		            	
		            	$usuario->set_fone1($this->fone1);
		            	$usuario->set_fone2($this->fone2);
		            	$usuario->set_email_alternativo($this->email_alternativo);
		            	$usuario->set_id(Login_Session::get_usuario_id());
		            	
		            	$endereco->set_cidade($object_cidade);
		            	$endereco->set_estado($object_estado);
		            	$endereco->set_numero($this->numero);
		            	$endereco->set_cep($this->cep);
		            	$endereco->set_bairro($this->bairro);
		            	$endereco->set_rua($this->rua);
		            	$endereco->set_complemento($this->complemento);
		            	
		            	$entidade->set_cpf_cnpj($this->cpf_cnpj);
		            	$entidade->set_site($this->site);
		            	$entidade->set_nome_comercial($this->nome_comercial);
		            	
		            	if (DAO_Usuario::Atualizar_Contato($usuario) !== false) {
		            		$entidade->set_usuario_id(Login_Session::get_usuario_id());
		            		$entidade->set_status_id(1);
		            		$entidade->set_data(date('Y-m-d H:i:s'));
		            		$entidade->set_imagem($this->Salvar_Imagem());
		            		
		            		$retorno = DAO_Entidade::Inserir($entidade);
		            		
			                if ($retorno != false) {
			                	$endereco->set_id(0);
			                	$endereco->set_entidade_id($retorno);
			                	
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
		            	$this->concluir_form['fone1'] = $this->fone1;
		            	$this->concluir_form['fone2'] = $this->fone2;
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
					echo "/application/view/resources/img/imagem_indisponivel.png";
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
				return "/application/view/resources/img/imagem_indisponivel.png";
			}
		}

        private function Salvar_Imagem() : ?string {
        	if (isset($_SESSION['imagem_tmp'])) {
        		$imagens = new Gerenciar_Imagens();
			
        		$imagem_tmp = $_SESSION['imagem_tmp'];
        		
        		unset($_SESSION['imagem_tmp']);
        		
        		$img_nome = $imagens->Arquivar_Imagem_Usuario($imagem_tmp);
        		
        		if (!empty($img_nome) AND $img_nome != false) {
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