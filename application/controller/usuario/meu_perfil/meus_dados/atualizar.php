<?php
namespace application\controller\usuario\meu_perfil\meus_dados;
	
	require_once RAIZ.'/application/model/common/util/login_session.php';
	require_once RAIZ.'/application/model/common/util/cpf_cnpj.php';
	require_once RAIZ.'/application/model/common/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/model/common/util/validador.php';
    require_once RAIZ.'/application/model/object/entidade.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/dao/entidade.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/atualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
    
	use application\model\common\util\Login_Session;
	use application\model\common\util\CPF_CNPJ;
	use application\model\common\util\Gerenciar_Imagens;
	use application\model\common\util\Validador;
    use application\model\object\Usuario as Object_Usuario;
    use application\model\object\Entidade as Object_Entidade;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\dao\Entidade as DAO_Entidade;
    use application\view\src\usuario\meu_perfil\meus_dados\Atualizar as View_Atualizar;
    use application\controller\include_page\menu\Usuario as Controller_Usuario;
    use \Exception;
	
    class Atualizar {

        function __construct() {
			
        }
        
        private $nome;
        private $fone1;
        private $fone2;
        private $email;
        private $confemail;
        private $email_alternativo;
        private $cpf_cnpj;
        private $site;
        private $nome_comercial;
        private $atualizar_form = array();
        private $atualizar_erros = array();
        private $atualizar_sucesso = array();
        private $atualizar_campos = array();
        private $entidade_form;
        private $usuario_form;
        
        public function set_nome($nome) {
        	try {
        		$this->nome = Validador::Usuario()::validar_nome($nome);
        		$this->atualizar_campos['erro_nome'] = 'certo';
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_nome'] = 'erro';
        		
        		$this->nome = Validador::Usuario()::filtrar_nome($nome);
        	}
        } 
        
        public function set_fone1($fone1) {
        	try {
        		$this->fone1 = Validador::Usuario()::validar_fone1($fone1);
        		$this->atualizar_campos['erro_fone1'] = 'certo';
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_fone1'] = 'erro';
        		
        		$this->fone1 = Validador::Usuario()::filtrar_fone1($fone1);
        	}
        }
        
        public function set_fone2($fone2 = null) {
        	try {
        		$this->fone2 = Validador::Usuario()::validar_fone2($fone2);
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_fone2'] = 'erro';
        		
        		$this->fone2 = Validador::Usuario()::filtrar_fone2($fone2);
        	}
        }
        
        public function set_email($email) {
        	try {
        		$this->email = Validador::Usuario()::validar_email($email);
        		$this->atualizar_campos['erro_email'] = 'certo';
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_email'] = 'erro';
        		
        		$this->email = Validador::Usuario()::filtrar_email($email);
        	}
        }
        
        public function set_confemail($confemail) {
        	try {
        		$this->confemail = Validador::Usuario()::validar_confemail($confemail, $this->email);
        		$this->atualizar_campos['erro_confemail'] = 'certo';
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_confemail'] = 'erro';
        		
        		$this->confemail = Validador::Usuario()::filtrar_confemail($confemail);
        	}
        }
        
        public function set_email_alternativo($email_alternativo = null) {
        	try {
        		$this->email_alternativo = Validador::Usuario()::validar_email_alternativo($email_alternativo);
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_email_alternativo'] = 'erro';
        		
        		$this->email_alternativo = Validador::Usuario()::filtrar_email_alternativo($email_alternativo);
        	}
        }
        
        public function set_cpf_cnpj($cpf_cnpj) {
        	try {
        		$this->cpf_cnpj = Validador::Entidade()::validar_cpf_cnpj($cpf_cnpj);
        		$this->atualizar_campos['erro_cpf_cnpj'] = 'certo';
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_cpf_cnpj'] = 'erro';
        		
        		$this->cpf_cnpj = Validador::Entidade()::filtrar_cpf_cnpj($cpf_cnpj);
        	}
        }
        
        public function set_site($site = null) {
        	try {
        		$this->site = Validador::Entidade()::validar_site($site);
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_site'] = 'erro';
        		
        		$this->site = Validador::Entidade()::filtrar_site($site);
        	}
        }
        
        public function set_nome_comercial($nome_comercial = null) {
        	try {
        		$this->nome_comercial = Validador::Entidade()::validar_nome_comercial($nome_comercial);
        	} catch (Exception $e) {
        		$this->atualizar_erros[] = $e->getMessage();
        		$this->atualizar_campos['erro_nome_comercial'] = 'erro';
        		
        		$this->nome_comercial = Validador::Entidade()::filtrar_nome_comercial($nome_comercial);
        	}
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		        	if (empty($atualizar_form)) {
		        		$this->Deletar_Imagem();
		        		unset($_SESSION['imagem_tmp']);
		        	}
		        	
		        	$this->entidade_form = DAO_Entidade::BuscarPorCOD(Login_Session::get_entidade_id());
		        	$this->usuario_form = DAO_Usuario::Buscar_Usuario(Login_Session::get_usuario_id());
		        	
		        	$view = new View_Atualizar($status);
		        	
		        	$view->set_atualizar_campos($this->atualizar_campos);
		        	$view->set_atualizar_erros($this->atualizar_erros);
		        	$view->set_atualizar_form($this->atualizar_form);
		        	$view->set_atualizar_sucesso($this->atualizar_sucesso);
		        	$view->set_entidade_form($this->entidade_form);
		        	$view->set_usuario_form($this->usuario_form);
		        	 
		        	$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public function Verificar_Evento() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		        	if (isset($_POST['restaurar_usuario'])) {
		        		$this->Restaurar_Usuario();
		        	} else if (isset($_POST['salvar_usuario'])) {
		        		$this->Atualizar_Usuario();
		        	} else if (isset($_POST['restaurar_entidade'])) {
		        		$this->Restaurar_Entidade();
		        	} else if (isset($_POST['salvar_entidade'])) {
		        		$this->Atualizar_Entidade();
		        	} else {
		        		$this->Salvar_Entidade();
		        		$this->Salvar_Usuario();
		        	}
		        
		        	$this->Carregar_Pagina();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        private function Restaurar_Usuario() : void {
        	$this->Salvar_Entidade();
        	$this->atualizar_campos = array();
        }
        
        private function Restaurar_Entidade() : void {
        	$this->Salvar_Usuario();
        	$this->Deletar_Imagem();
        	
        	unset($_SESSION['imagem_tmp']);
        	$this->atualizar_campos = array();
        }
        
        private function Salvar_Usuario() : void {
        	$this->atualizar_form['nome'] = $this->nome;
        	$this->atualizar_form['email'] = $this->email;
        	$this->atualizar_form['confemail'] = $this->confemail;
        	$this->atualizar_form['fone1'] = $this->fone1;
        	$this->atualizar_form['fone2'] = $this->fone2;
        	$this->atualizar_form['email_alternativo'] = $this->email_alternativo;
        }
        
        private function Salvar_Entidade() : void {
        	$this->atualizar_form['nome_comercial'] = $this->nome_comercial;
        	$this->atualizar_form['cpf_cnpj'] = $this->cpf_cnpj;
        	$this->atualizar_form['site'] = $this->site;
        }
        
        private function Atualizar_Entidade() : void {
            if (empty($this->atualizar_erros)) {
            	$entidade = new Object_Entidade();
            	
            	$entidade->set_cpf_cnpj($this->cpf_cnpj);
            	$entidade->set_site($this->site);
            	$entidade->set_nome_comercial($this->nome_comercial);
            	$entidade->set_usuario_id(Login_Session::get_usuario_id());
            	$entidade->set_imagem($this->Salvar_Imagem());
            	
            	if (empty($entidade->get_imagem())) {
            		if (DAO_Entidade::Atualizar_Dados($entidade) === false) {
            			$this->atualizar_erros[] = "Erro ao tentar Atualizar Entidade";
            			$this->atualizar_campos['erro_cpf_cnpj'] = "";
            		} else {
                		$this->atualizar_sucesso[] = "Entidade Atualizada com Sucesso";
                		Login_Session::set_entidade_nome($entidade->get_nome_comercial());
                	}
            	} else if ($entidade->get_imagem() == "del") {
            		$entidade->set_imagem(null);
            		
                	if (DAO_Entidade::Atualizar($entidade) === false) {
                		$this->atualizar_erros[] = "Erro ao tentar Atualizar Entidade";
                		$this->atualizar_campos['erro_cpf_cnpj'] = "";
                	} else {
                		$this->atualizar_sucesso[] = "Entidade Atualizada com Sucesso";
                		Login_Session::set_entidade_nome($entidade->get_nome_comercial());
                	}
                } else {
                	if (DAO_Entidade::Atualizar($entidade) === false) {
                		$this->atualizar_erros[] = "Erro ao tentar Atualizar Entidade";
                		$this->atualizar_campos['erro_cpf_cnpj'] = "";
                	} else {
                		$this->atualizar_sucesso[] = "Entidade Atualizada com Sucesso";
                		Login_Session::set_entidade_nome($entidade->get_nome_comercial());
                	}
                }
            }
            
            $this->Salvar_Usuario();
        }
        
        private function Atualizar_Usuario() : void {
            if (empty($this->atualizar_erros)) {
            	$usuario = new Object_Usuario();
            	
            	$usuario->set_nome($this->nome);
            	$usuario->set_email($this->email);
            	$usuario->set_fone1($this->fone1);
            	$usuario->set_fone2($this->fone2);
            	$usuario->set_email_alternativo($this->email_alternativo);
            	$usuario->set_id(Login_Session::get_usuario_id());
            	
                if (DAO_Usuario::Atualizar($usuario) === false) {
                	$this->atualizar_erros[] = "Erro ao tentar Atualizar Usuario";
                	$this->atualizar_campos['erro_nome'] = "";
                	$this->atualizar_campos['erro_email'] = "";
                	$this->atualizar_campos['erro_confemail'] = "";
                } else {
                	Login_Session::set_usuario_nome($usuario->get_nome());
                	
                	$this->atualizar_sucesso[] = "Usuario Atualizado com Sucesso";
                }
            }
            
            $this->Salvar_Entidade();
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
					if ($_SESSION['imagem_tmp'] != "del") {
						$imagens = new Gerenciar_Imagens();
						
						$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
					}
				}
	
				$_SESSION['imagem_tmp'] = "del";
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
        	if (isset($_SESSION['imagem_tmp'])) {
        		$imagens = new Gerenciar_Imagens();
				
        		if ($_SESSION['imagem_tmp'] == "del") {
					$imagens->Deletar_Imagem_Usuario();
        			return "del";
        		} else {
					$img_link = $imagens->Atualizar_Imagem_Usuario($_SESSION['imagem_tmp']);
					unset($_SESSION['imagem_tmp']);
					return $img_link;
				}
			} else {
				return null;
			}
        }
    }
?>