<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once(RAIZ.'/application/model/object/class_dados_usuario.php');
    require_once(RAIZ.'/application/model/object/class_endereco.php');
    require_once(RAIZ.'/application/model/object/class_contato.php');
    require_once(RAIZ.'/application/model/dao/dao_contato.php');
	require_once(RAIZ.'/application/model/dao/dao_endereco.php');
	require_once(RAIZ.'/application/model/dao/dao_dados_usuario.php');
    require_once(RAIZ.'/application/model/dao/dao_estado.php');
    require_once(RAIZ.'/application/model/dao/dao_cidade.php');
	require_once(RAIZ.'/application/model/util/gerenciar_imagens.php');
    
    use application\model\object\Dados_Usuario;
    use application\model\object\Endereco;
    use application\model\object\Contato;
    use application\model\dao\DAO_Contato;
	use application\model\dao\DAO_Dados_Usuario;
	use application\model\dao\DAO_Endereco;
    use application\model\dao\DAO_Estado;
    use application\model\dao\DAO_Cidade;
    use application\model\util\Gerenciar_Imagens;
	
    @session_start;

    class Concluir {
		
        function __construct() {
            
        }
        
        private static $erros_concluir;
        
        public static function Cadastrar(Contato $contato, Endereco $endereco, Dados_Usuario $dados_usuario) {
           	self::$erros_concluir = array();
            $cnclr_campos = array('erro_fone1' => "certo", 'erro_cidade' => "certo", 'erro_estado' => "certo", 'erro_numero' => "certo", 'erro_cep' => "certo", 'erro_bairro' => "certo", 'erro_rua' => "certo", 'erro_cpf_cnpj' => "certo");
            
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
            } else {
                $_SESSION['erros_concluir'] = self::$erros_concluir;
                $_SESSION['cnclr_campos'] = $cnclr_campos;
            }
        }
        
		public static function Salvar_Imagem_TMP($arquivo) {
			$imagens = new Gerenciar_Imagens();
			
			$imagens->Armazenar_Imagem_Temporaria($arquivo);
			
			$_SESSION['imagem_tmp'] = $imagens->get_nome();
			
			return $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
		}
		
		public static function Deletar_Imagem() {
			if (isset($_SESSION['imagem_tmp'])) {
				$imagens = new Gerenciar_Imagens();
				
				$imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
				
				unset($_SESSION['imagem_tmp']);
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

        private function Salvar_Imagem() {
        	if (isset($_SESSION['imagem_tmp'])) {
        		$imagens = new Gerenciar_Imagens();
			
				return $imagens->Arquivar_Imagem_Usuario($_SESSION['imagem_tmp']);
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