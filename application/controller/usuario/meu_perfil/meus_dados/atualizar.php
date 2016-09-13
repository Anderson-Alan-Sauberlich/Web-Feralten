<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once(RAIZ.'/application/model/object/dados_usuario.php');
    require_once(RAIZ.'/application/model/object/usuario.php');
    require_once(RAIZ.'/application/model/object/contato.php');
    require_once(RAIZ.'/application/model/dao/usuario.php');
    require_once(RAIZ.'/application/model/dao/dados_usuario.php');
    require_once(RAIZ.'/application/model/dao/contato.php');
	require_once(RAIZ.'/application/model/util/gerenciar_imagens.php');
    
    use application\model\object\Usuario as Object_Usuario;
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\object\Contato as Object_Contato;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\dao\Contato as DAO_Contato;
    use application\model\dao\Dados_Usuario as DAO_Dados_Usuario;
	use application\model\util\Gerenciar_Imagens;
    
    @session_start;
    
    class Atualizar {

        function __construct() {
            
        }
        
        private static $erros_dadosusuario;
        
        public static function Atualizar_Contato(Object_Contato $contato) {
            $erros_contato = array();
            $alt_campos = array('erro_fone1' => "certo");
            
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
        }
        
        public static function Atualizar_DadosUsuario(Object_Dados_Usuario $dados_usuario) {
            self::$erros_dadosusuario = array();
            $alt_campos = array('erro_cpf_cnpj' => "certo");
            
            if (empty($dados_usuario->get_cpf_cnpj())) {
                self::$erros_dadosusuario[] = "Informe um CPF ou CNPJ";
                $alt_campos['erro_cpf_cnpj'] = "erro";
            }

            if (empty(self::$erros_dadosusuario)) {
				$dados_usuario->set_imagem(self::Salvar_Imagem());
            }

            if (empty(self::$erros_dadosusuario)) {
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
                $_SESSION['erros_dadosusuario'] = self::$erros_dadosusuario;
            }
            
            $_SESSION['alt_campos'] = $alt_campos;
        }
        
        public static function Atualizar_Usuario(Object_Usuario $usuario) {
            $erros_usuario = array();
            $alt_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' =>  "certo");
            
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
        }
        
        public static function Pegar_Login_Nome() {
            return unserialize($_SESSION['usuario'])->get_nome();
        }
        
        public static function Pegar_Login_Email() {
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
                
        private function Pegar_DadosUsuario(Object_Dados_Usuario $dados_usuario) {
            $dados_usuario = DAO_Dados_Usuario::BuscarPorCOD(unserialize($_SESSION['usuario'])->get_id());
            
            $_SESSION['dados_usuario'] = $dados_usuario;
            
            return $dados_usuario;
        }
        
        private function Pegar_Contato(Object_Contato $contato) {
            $contato = DAO_Contato::Buscar_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id());
            
            $_SESSION['contato'] = $contato;
            
            return $contato;
        }
		
		public static function Salvar_Imagem_TMP($arquivo) {
			$imagens = new Gerenciar_Imagens();
			
			$imagens->Armazenar_Imagem_Temporaria($arquivo);
			
			$_SESSION['imagem_tmp'] = $imagens->get_nome();
			
			return $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
		}
		
		public static function Deletar_Imagem() {
			if (isset($_SESSION['imagem_tmp'])) {
				if ($_SESSION['imagem_tmp'] != "del") {
					$imagens = new Gerenciar_Imagens();
					
					$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
				}
			}

			$_SESSION['imagem_tmp'] = "del";
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
        
        private function Salvar_Imagem() {
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