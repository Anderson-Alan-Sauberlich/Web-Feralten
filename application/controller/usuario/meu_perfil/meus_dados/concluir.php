<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once RAIZ.'/application/model/object/dados_usuario.php';
    require_once RAIZ.'/application/model/object/endereco.php';
    require_once RAIZ.'/application/model/object/contato.php';
    require_once RAIZ.'/application/model/dao/contato.php';
	require_once RAIZ.'/application/model/dao/endereco.php';
	require_once RAIZ.'/application/model/dao/dados_usuario.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
	require_once RAIZ.'/application/model/util/gerenciar_imagens.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/concluir.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
    
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\object\Endereco as Object_Endereco;
    use application\model\object\Contato as Object_Contato;
    use application\model\dao\Contato as DAO_Contato;
	use application\model\dao\Dados_Usuario as DAO_Dados_Usuario;
	use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Estado as DAO_Estado;
    use application\model\dao\Cidade as DAO_Cidade;
    use application\model\util\Gerenciar_Imagens;
	use application\view\src\usuario\meu_perfil\meus_dados\Concluir as View_Concluir;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
    
    @session_start();

    class Concluir {
		
        function __construct() {
            
        }
        
        private static $erros_concluir;
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
        			new View_Concluir($status);
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public static function Concluir_Cadastro() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 0) {
		           	self::$erros_concluir = array();
		            $cnclr_campos = array('erro_fone1' => "certo", 'erro_cidade' => "certo", 'erro_estado' => "certo", 'erro_numero' => "certo", 'erro_cep' => "certo", 'erro_bairro' => "certo", 'erro_rua' => "certo", 'erro_cpf_cnpj' => "certo");
		            
		            $contato = new Object_Contato();
		            $endereco = new Object_Endereco();
		            $dados_usuario = new Object_Dados_Usuario();
		            
		            $contato->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            $contato->set_telefone1($_POST['fone1']);
		            $contato->set_telefone2($_POST['fone2']);
		            $contato->set_email($_POST['emailcontato']);
		            
		            $endereco->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            $endereco->set_cidade_id($_POST['cidade']);
		            $endereco->set_estado_id($_POST['estado']);
		            $endereco->set_numero($_POST['numero']);
		            $endereco->set_cep($_POST['cep']);
		            $endereco->set_rua($_POST['rua']);
		            $endereco->set_complemento($_POST['complemento']);
		            $endereco->set_bairro($_POST['bairro']);
		            
		            $dados_usuario->set_usuario_id(unserialize($_SESSION['usuario'])->get_id());
		            $dados_usuario->set_cpf_cnpj($_POST['cpf_cnpj']);
		            $dados_usuario->set_site($_POST['site']);
		            $dados_usuario->set_nome_fantasia($_POST['nomedadosusuario']);
		            $dados_usuario->set_status_id(1);
		            $dados_usuario->set_data(date('Y-m-d H:i:s'));
		            
		            if (empty($contato->get_telefone1())) {
		                self::$erros_concluir[] = "Informe um Nº de Telefone para Telefone 1";
		                $cnclr_campos['erro_fone1'] = "erro";
		            }
		            
		            if (empty($endereco->get_cidade_id()) OR $endereco->get_cidade_id() <= 0) {
		                self::$erros_concluir[] = "Seleciona sua Cidade";
		                $cnclr_campos['erro_cidade'] = "erro";
		            }
		            if (empty($endereco->get_estado_id()) OR $endereco->get_estado_id() <= 0) {
		                self::$erros_concluir[] = "Seleciona seu Estado";
		                $cnclr_campos['erro_estado'] = "erro";
		            }
		            if (empty($endereco->get_numero())) {
		                self::$erros_concluir[] = "Informe o Numero do seu Endereço";
		                $cnclr_campos['erro_numero'] = "erro";
		            }
		            if (empty($endereco->get_cep())) {
		                self::$erros_concluir[] = "Informe seu CEP";
		                $cnclr_campos['erro_cep'] = "erro";
		            }
		            if (empty($endereco->get_bairro())) {
		                self::$erros_concluir[] = "Informe seu Bairro";
		                $cnclr_campos['erro_bairro'] = "erro";
		            }
		            if (empty($endereco->get_rua())) {
		                self::$erros_concluir[] = "Informe sua Rua";
		                $cnclr_campos['erro_rua'] = "erro";
		            }
		            
		            if (empty($dados_usuario->get_cpf_cnpj())) {
		                self::$erros_concluir[] = "Informe seu CPF ou CNPJ";
		                $cnclr_campos['erro_cpf_cnpj'] = "erro";
		            }
		            
		            if (empty(self::$erros_concluir)) {
		                $dados_usuario->set_imagem(self::Salvar_Imagem());
		            }
		            
		            if (empty(self::$erros_concluir)) {
		                DAO_Dados_Usuario::Inserir($dados_usuario);
		                DAO_Endereco::Inserir($endereco);
		                DAO_Contato::Inserir($contato);
		                
		                return 'certo';
		            } else {
		                $_SESSION['erros_concluir'] = self::$erros_concluir;
		                $_SESSION['cnclr_campos'] = $cnclr_campos;
		                
		                $form_concluir = array();
		                
		                $form_concluir['fone1'] = $_POST['fone1'];
		                $form_concluir['fone2'] = $_POST['fone2'];
		                $form_concluir['cidade'] = $_POST['cidade'];
		                $form_concluir['estado'] = $_POST['estado'];
		                $form_concluir['numero'] = $_POST['numero'];
		                $form_concluir['cep'] = $_POST['cep'];
		                $form_concluir['rua'] = $_POST['rua'];
		                $form_concluir['complemento'] = $_POST['complemento'];
		                $form_concluir['bairro'] = $_POST['bairro'];
		                $form_concluir['cpf_cnpj'] = $_POST['cpf_cnpj'];
		                $form_concluir['nomedadosusuario'] = $_POST['nomedadosusuario'];
		                $form_concluir['emailcontato'] = $_POST['emailcontato'];
		                $form_concluir['site'] = $_POST['site'];
		                
		                $_SESSION['form_concluir'] = $form_concluir;
		                
		                return 'erro';
		            }
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public static function Retornar_Cidades_Por_Estado() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
	        	if (isset($_GET['estado'])) {
	        		View_Concluir::Mostrar_Cidades($_GET['estado']);
	        	}
        	} else {
        		return false;
        	}
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
					$imagens = new Gerenciar_Imagens();
					
					$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
					
					unset($_SESSION['imagem_tmp']);
				}
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
				return "/application/view/resources/img/imagem_Indisponivel.png";
			}
		}

        private function Salvar_Imagem() {
        	if (isset($_SESSION['imagem_tmp'])) {
        		$imagens = new Gerenciar_Imagens();
			
        		$imagem_tmp = $_SESSION['imagem_tmp'];
        		
        		unset($_SESSION['imagem_tmp']);
        		
				return $imagens->Arquivar_Imagem_Usuario($imagem_tmp);
			}
        }

		public static function Buscar_Todos_Estados() {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidades_Por_Estado($id_estado) {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
    }
?>