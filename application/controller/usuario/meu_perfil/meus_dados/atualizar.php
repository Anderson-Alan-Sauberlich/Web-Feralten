<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once RAIZ.'/application/model/object/dados_usuario.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/model/object/contato.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/dao/dados_usuario.php';
    require_once RAIZ.'/application/model/dao/contato.php';
	require_once RAIZ.'/application/model/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/atualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
    
    use application\model\object\Usuario as Object_Usuario;
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\object\Contato as Object_Contato;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\dao\Contato as DAO_Contato;
    use application\model\dao\Dados_Usuario as DAO_Dados_Usuario;
	use application\model\util\Gerenciar_Imagens;
    use application\view\src\usuario\meu_perfil\meus_dados\Atualizar as View_Atualizar;
    use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
    @session_start();
    
    class Atualizar {

        function __construct() {
			
        }
        
        private static $form_atualizar;
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		        	if (empty($_SESSION['form_atualizar'])) {
		        		self::Deletar_Imagem();
		        		unset($_SESSION['imagem_tmp']);
		        	}
		        	
		        	new View_Atualizar($status);
		        	
		            if (isset($_SESSION['dados_usuario'])) {
		        		unset($_SESSION['dados_usuario']);
		        	}
		        	
		        	if (isset($_SESSION['contato'])) {
		        		unset($_SESSION['contato']);
		        	}
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public static function Verificar_Evento() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
		        	self::$form_atualizar = array();
		        
		        	if (isset($_POST['restaurar_login'])) {
		        		self::Restaurar_Usuario();
		        	} else if (isset($_POST['salvar_login'])) {
		        		self::Atualizar_Usuario();
		        	} else if (isset($_POST['restaurar_dadosusuario'])) {
		        		self::Restaurar_DadosUsuario();
		        	} else if (isset($_POST['salvar_dadosusuario'])) {
		        		self::Atualizar_DadosUsuario();
		        	} else if (isset($_POST['restaurar_contato'])) {
		        		self::Restaurar_Contato();
		        	} else if (isset($_POST['salvar_contato'])) {
		        		self::Atualizar_Contato();
		        	} else {
		        		self::Salvar_Contato();
		        		self::Salvar_Dados_Usuario();
		        		self::Salvar_Usuario();
		        	}
		        
		        	$_SESSION['form_atualizar'] = self::$form_atualizar;
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        private static function Restaurar_Usuario() {
        	self::Salvar_Contato();
        	self::Salvar_Dados_Usuario();
        }
        
        private static function Restaurar_DadosUsuario() {
        	self::Salvar_Usuario();
        	self::Salvar_Contato();
        	self::Deletar_Imagem();
        	
        	unset($_SESSION['imagem_tmp']);
        }
        
        private static function Restaurar_Contato() {
        	self::Salvar_Usuario();
        	self::Salvar_Dados_Usuario();
        }
        
        private static function Salvar_Usuario() {
        	self::$form_atualizar['nome'] = $_POST['nome'];
        	self::$form_atualizar['email'] = $_POST['email'];
        	self::$form_atualizar['confemail'] = $_POST['confemail'];
        }
        
        private static function Salvar_Dados_Usuario() {
        	self::$form_atualizar['nomedadosusuario'] = $_POST['nomedadosusuario'];
        	self::$form_atualizar['cpf_cnpj'] = $_POST['cpf_cnpj'];
        	self::$form_atualizar['site'] = $_POST['site'];
        }
        
        private static function Salvar_Contato() {
        	self::$form_atualizar['fone1'] = $_POST['fone1'];
        	self::$form_atualizar['fone2'] = $_POST['fone2'];
        	self::$form_atualizar['emailcontato'] = $_POST['emailcontato'];
        }
        
        private static function Atualizar_Contato() {
            $erros_contato = array();
            $alt_campos = array('erro_fone1' => "certo");
            
            $contato = new Object_Contato();
            
            $contato->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $contato->set_telefone1($_POST['fone1']);
            $contato->set_telefone2($_POST['fone2']);
            $contato->set_email($_POST['emailcontato']);
            
            if (empty($contato->get_telefone1())) {
                $erros_contato[] = "Informe um Nº de Telefone para Telefone 1";
                $alt_campos['erro_fone1'] = "erro";
            }
            
            if (empty($erros_contato)) {
                DAO_Contato::Atualizar($contato);
				
				$_SESSION['success_contato'][] = "O Contato do seu Usuario foi Atualizado com Sucesso!";
            } else {
                $_SESSION['erros_contato'] = $erros_contato;
            }
            
            $_SESSION['alt_campos'] = $alt_campos;
            
            self::Salvar_Usuario();
            self::Salvar_Dados_Usuario();
        }
        
        private static function Atualizar_DadosUsuario() {
            $erros_dadosusuario = array();
            $alt_campos = array('erro_cpf_cnpj' => "certo");
            
            $dados_usuario = new Object_Dados_Usuario();
            
            $dados_usuario->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $dados_usuario->set_cpf_cnpj($_POST['cpf_cnpj']);
            $dados_usuario->set_nome_fantasia($_POST['nomedadosusuario']);
            $dados_usuario->set_site($_POST['site']);
            
            if (empty($dados_usuario->get_cpf_cnpj())) {
                $erros_dadosusuario[] = "Informe um CPF ou CNPJ";
                $alt_campos['erro_cpf_cnpj'] = "erro";
            }

            if (empty($erros_dadosusuario)) {
				$dados_usuario->set_imagem(self::Salvar_Imagem());
            }

            if (empty($erros_dadosusuario)) {
            	if (empty($dados_usuario->get_imagem())) {
            		DAO_Dados_Usuario::Atualizar_Dados($dados_usuario);
            	} else if ($dados_usuario->get_imagem() == "del") {
            		$dados_usuario->set_imagem(null);
                	DAO_Dados_Usuario::Atualizar($dados_usuario);
                } else {
                	DAO_Dados_Usuario::Atualizar($dados_usuario);
                }
                
                $_SESSION['success_dadosusuario'][] = "Seus Dados de Usuario foram Atualizados com Sucesso!";
            } else {
                $_SESSION['erros_dadosusuario'] = $erros_dadosusuario;
            }
            
            $_SESSION['alt_campos'] = $alt_campos;
            
            self::Salvar_Contato();
            self::Salvar_Usuario();
        }
        
        private static function Atualizar_Usuario() {
            $erros_usuario = array();
            $alt_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' =>  "certo");
            
            $usuario = new Object_Usuario();
            
            $usuario->set_id(unserialize($_SESSION['usuario'])->get_id());
            $usuario->set_nome($_POST["nome"]);
            $usuario->set_senha(unserialize($_SESSION['usuario'])->get_senha());
            $usuario->set_ultimo_login(unserialize($_SESSION['usuario'])->get_ultimo_login());
            
            if ($_POST['confemail'] == $_POST['email']) {
            	$usuario->set_email($_POST['email']);
            } else if (isset($_POST['confemail']) AND empty($_POST['email'])) {
            	$usuario->set_email("erro1");
            } else if (isset($_POST['email']) AND empty($_POST['confemail'])) {
            	$usuario->set_email("erro2");
            } else {
            	$usuario->set_email("erro");
            }
            
            if (empty($usuario->get_nome())) {
                $erros_usuario[] = "Digite seu Nome Completo";
                $alt_campos['erro_nome'] = "erro";
            }
            if (empty($usuario->get_email())) {
                $erros_usuario[] = "Digite seu Email";
                $alt_campos['erro_email'] = "erro";
				$alt_campos['erro_confemail'] = "erro";
            } else if ($usuario->get_email() == "erro") {
                $erros_usuario[] = "Digite o E-Mails Duas Vezes Igualmente";
                $alt_campos['erro_email'] = "erro";
                $alt_campos['erro_confemail'] = "erro";
            } else if ($usuario->get_email() == "erro1") {
                $erros_usuario[] = "Preencha o Campo E-Mail";
                $alt_campos['erro_email'] = "erro";
            } else if ($usuario->get_email() == "erro2") {
            	$erros_usuario[] = "Preencha o Campo Comfirmar E-Mail";
            	$alt_campos['erro_confemail'] = "erro";
            }
            
            if (empty($erros_usuario)) {
                DAO_Usuario::Atualizar($usuario);
                
                $_SESSION['usuario'] = serialize($usuario);
				
				$_SESSION['success_usuario'][] = "O Login do seu Usuario foi Atualizado com Sucesso!";
            } else {
                $_SESSION['erros_usuario'] = $erros_usuario;
            }
            
            $_SESSION['alt_campos'] = $alt_campos;
            
            self::Salvar_Contato();
            self::Salvar_Dados_Usuario();
        }
        
        public static function Pegar_Usuario_Nome() {
            return unserialize($_SESSION['usuario'])->get_nome();
        }
        
        public static function Pegar_Usuario_Email() {
            return unserialize($_SESSION['usuario'])->get_email();
        }
        
        public static function Pegar_DadosUsuario_Nome() {
            $dados_usuario = new Object_Dados_Usuario();
            
            if (isset($_SESSION['dados_usuario'])) {
                $dados_usuario = $_SESSION['dados_usuario'];
                
                if ($dados_usuario->get_nome_fantasia() != null) {
                    return $dados_usuario->get_nome_fantasia();
                }
            } else {
                $dados_usuario = self::Pegar_DadosUsuario($dados_usuario);
                
                if ($dados_usuario->get_nome_fantasia() != null) {
                    return $dados_usuario->get_nome_fantasia();
                }
            }
        }
        
        public static function Pegar_DadosUsuario_CPF_CNPJ() {
            $dados_usuario = new Object_Dados_Usuario();
            
            if (isset($_SESSION['dados_usuario'])) {
                $dados_usuario = $_SESSION['dados_usuario'];
                
                if ($dados_usuario->get_cpf_cnpj() != null) {
                    return $dados_usuario->get_cpf_cnpj();
                }
            } else {
                $dados_usuario = self::Pegar_DadosUsuario($dados_usuario);
                
                if ($dados_usuario->get_cpf_cnpj() != null) {
                    return $dados_usuario->get_cpf_cnpj();
                }
            }
        }
        
        public static function Pegar_DadosUsuario_Imagem() {
            $dados_usuario = new Object_Dados_Usuario();
            
            if (isset($_SESSION['dados_usuario'])) {
                $dados_usuario = $_SESSION['dados_usuario'];
                
                if ($dados_usuario->get_imagem() != null) {
                    return $dados_usuario->get_imagem();
                }
            } else {
                $dados_usuario = self::Pegar_DadosUsuario($dados_usuario);
                
                if ($dados_usuario->get_imagem() != null) {
                    return $dados_usuario->get_imagem();
                }
            }
        }
        
        public static function Pegar_DadosUsuario_Site() {
            $dados_usuario = new Object_Dados_Usuario();
            
            if (isset($_SESSION['dados_usuario'])) {
                $dados_usuario = $_SESSION['dados_usuario'];
                
                if ($dados_usuario->get_site() != null) {
                    return $dados_usuario->get_site();
                }
            } else {
                $dados_usuario = self::Pegar_DadosUsuario($dados_usuario);
                
                if ($dados_usuario->get_site() != null) {
                    return $dados_usuario->get_site();
                }
            }
        }
        
        public static function Pegar_Contato_Fone1() {
            $contato = new Object_Contato();
            
            if (isset($_SESSION['contato'])) {
                $contato = $_SESSION['contato'];
                
                if ($contato->get_telefone1() != null) {
                    return $contato->get_telefone1();
                }
            } else {
                $contato = self::Pegar_Contato($contato);
                
                if ($contato->get_telefone1() != null) {
                    return $contato->get_telefone1();
                }
            }
        }
        
        public static function Pegar_Contato_Fone2() {
            $contato = new Object_Contato();
            
            if (isset($_SESSION['contato'])) {
                $contato = $_SESSION['contato'];
                
                if ($contato->get_telefone2() != null) {
                    return $contato->get_telefone2();
                }
            } else {
                $contato = self::Pegar_Contato($contato);
                
                if ($contato->get_telefone2() != null) {
                    return $contato->get_telefone2();
                }
            }
        }
        
        public static function Pegar_Contato_Email() {
            $contato = new Object_Contato();
            
            if (isset($_SESSION['contato'])) {
                $contato = $_SESSION['contato'];
                
                if ($contato->get_email() != null) {
                    return $contato->get_email();
                }
            } else {
                $contato = self::Pegar_Contato($contato);
                
                if ($contato->get_email() != null) {
                    return $contato->get_email();
                }
            }
        }
                
        private static function Pegar_DadosUsuario(Object_Dados_Usuario $dados_usuario) {
            $dados_usuario = DAO_Dados_Usuario::BuscarPorCOD(unserialize($_SESSION['usuario'])->get_id());
            
            $_SESSION['dados_usuario'] = $dados_usuario;
            
            return $dados_usuario;
        }
        
        private static function Pegar_Contato(Object_Contato $contato) {
            $contato = DAO_Contato::Buscar_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id());
            
            $_SESSION['contato'] = $contato;
            
            return $contato;
        }
		
		public static function Salvar_Imagem_TMP() {
			if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
				if (isset($_FILES['imagem'])) {
					$imagens = new Gerenciar_Imagens();
					
					$imagens->Armazenar_Imagem_Temporaria($_FILES['imagem']);
					
					$_SESSION['imagem_tmp'] = $imagens->get_nome();
					
					echo $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
				}
			} else {
				return false;
			}
		}
		
		public static function Deletar_Imagem() {
			if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
				if (isset($_SESSION['imagem_tmp'])) {
					if ($_SESSION['imagem_tmp'] != "del") {
						$imagens = new Gerenciar_Imagens();
						
						$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
					}
				}
	
				$_SESSION['imagem_tmp'] = "del";
			} else {
				return false;
			}
		}
		
		public static function Pegar_Imagem_URL($nome_imagem) {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-200x150");
			
			if (isset($caminho_imagem)) {
				return $imagens::Gerar_Data_URL($caminho_imagem);
			} else {
				return "/resources/img/imagem_Indisponivel.png";
			}
		}
        
        private static function Salvar_Imagem() {
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