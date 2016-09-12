<?php
namespace application\controller\usuario\meu_perfil\auto_pecas;

    require_once(RAIZ.'/application/model/object/class_usuario.php');
    require_once(RAIZ.'/application/model/object/class_categoria.php');
    require_once(RAIZ.'/application/model/object/class_marca.php');
    require_once(RAIZ.'/application/model/object/class_modelo.php');
	require_once(RAIZ.'/application/model/object/class_versao.php');
	require_once(RAIZ.'/application/model/object/class_categoria_compativel.php');
	require_once(RAIZ.'/application/model/object/class_marca_compativel.php');
	require_once(RAIZ.'/application/model/object/class_modelo_compativel.php');
	require_once(RAIZ.'/application/model/object/class_versao_compativel.php');
	require_once(RAIZ.'/application/model/object/class_peca.php');
	require_once(RAIZ.'/application/model/object/class_lista_pativel.php');
	require_once(RAIZ.'/application/model/object/class_contato.php');
	require_once(RAIZ.'/application/model/object/class_endereco.php');
	require_once(RAIZ.'/application/model/object/class_foto_peca.php');
    require_once(RAIZ.'/application/model/dao/dao_categoria.php');
    require_once(RAIZ.'/application/model/dao/dao_marca.php');
    require_once(RAIZ.'/application/model/dao/dao_modelo.php');
    require_once(RAIZ.'/application/model/dao/dao_versao.php');
    require_once(RAIZ.'/application/model/dao/dao_categoria_compativel.php');
    require_once(RAIZ.'/application/model/dao/dao_marca_compativel.php');
    require_once(RAIZ.'/application/model/dao/dao_modelo_compativel.php');
    require_once(RAIZ.'/application/model/dao/dao_versao_compativel.php');
	require_once(RAIZ.'/application/model/dao/dao_status_peca.php');
	require_once(RAIZ.'/application/model/dao/dao_lista_pativel.php');
	require_once(RAIZ.'/application/model/dao/dao_peca.php');
	require_once(RAIZ.'/application/model/dao/dao_contato.php');
	require_once(RAIZ.'/application/model/dao/dao_endereco.php');
	require_once(RAIZ.'/application/model/dao/dao_foto_peca.php');
	require_once(RAIZ.'/application/model/util/gerenciar_imagens.php');
	
    use application\model\object\Usuario;
    use application\model\object\Categoria;
    use application\model\object\Marca;
    use application\model\object\Modelo;
	use application\model\object\Versao;
	use application\model\object\Categoria_Compativel;
	use application\model\object\Marca_Compativel;
	use application\model\object\Modelo_Compativel;
	use application\model\object\Versao_Compativel;
	use application\model\object\Peca;
	use application\model\object\Lista_Pativel;
	use application\model\object\Contato;
	use application\model\object\Endereco;
	use application\model\object\Foto_Peca;
    use application\model\dao\DAO_Categoria;
    use application\model\dao\DAO_Marca;
    use application\model\dao\DAO_Modelo;
    use application\model\dao\DAO_Versao;
    use application\model\dao\DAO_Categoria_Compativel;
    use application\model\dao\DAO_Marca_Compativel;
    use application\model\dao\DAO_Modelo_Compativel;
    use application\model\dao\DAO_Versao_Compativel;
	use application\model\dao\DAO_Status_Peca;
	use application\model\dao\DAO_Peca;
	use application\model\dao\DAO_Lista_Pativel;
	use application\model\dao\DAO_Contato;
	use application\model\dao\DAO_Endereco;
	use application\model\dao\DAO_Foto_Peca;
	use application\model\util\Gerenciar_Imagens;
	
	@session_start();
	
    class Cadastrar {

        function __construct() {
            
        }
		
		public static function Cadastrar(Peca $peca, $pativeis) {
			$erros_cadastrar_peca = array();
			$sucesso_cadastrar_peca = array();
			$campos_cadastrar_peca = array('erro_peca' => "certo");
			
			if (empty($peca->get_nome())) {
				$campos_cadastrar_peca['erro_peca'] = "erro";
				$erros_cadastrar_peca[] = "Digite o Nome da Peça";
			}
			
			if (empty($peca->get_status_id())) {
				$peca->set_status_id(null);
			}
			
			if (empty($peca->get_preco())) {
				$peca->set_preco(null);
			}
			
			if (empty($peca->get_fabricante())) {
				$peca->set_fabricante(null);
			}
			
			if (empty($peca->get_descricao())) {
				$peca->set_descricao(null);
			}
			
			if (empty($peca->get_serie())) {
				$peca->set_serie(null);
			}
			
			if (!empty($peca->get_prioridade())) {
				$peca->set_prioridade(true);
			}
			
			if (empty($erros_cadastrar_peca)) {
				$peca->set_contato_id(DAO_Contato::Buscar_Por_Id_Usuario($peca->get_usuario_id())->get_id());
				$peca->set_endereco_id(DAO_Endereco::Buscar_Por_Id_Usuario($peca->get_usuario_id())->get_id());
				
				$id_peca = DAO_Peca::Inserir($peca);
				
				if (isset($id_peca) AND isset($pativeis)) {
					foreach ($pativeis as $pativel) {
						$pativel->set_peca_id($id_peca);
						DAO_Lista_Pativel::Inserir($pativel);
					}
				}
				
				if (isset($id_peca) AND isset($_SESSION['imagens_tmp'])) {
					$imagens = new Gerenciar_Imagens();
					$diretorios_imagens = array();
					
					$diretorios_imagens = $imagens->Arquivar_Imagem_Peca($_SESSION['imagens_tmp'], $id_peca);
					
					if (isset($diretorios_imagens)) {
						$indice = 0;
						
						foreach ($diretorios_imagens as $diretorio) {
							$foto_peca = new Foto_Peca();
							$indice++;
							
							$foto_peca->set_peca_id($id_peca);
							$foto_peca->set_endereco($diretorio);
							$foto_peca->set_numero($indice);
							
							DAO_Foto_Peca::Inserir($foto_peca);
						}
					}
				}
				
				$sucesso_cadastrar_peca[] = "Peça Cadastrada Com Sucesso";
				$_SESSION['sucesso_cadastrar_peca'] = $sucesso_cadastrar_peca;
				
				return true;
			} else {
				$_SESSION['erros_cadastrar_peca'] = $erros_cadastrar_peca;
				$_SESSION['campos_cadastrar_peca'] = $campos_cadastrar_peca;
				
				return false;
			}
		}

		public static function Cadastrar_Nova_Marca(Marca $marca) {
			DAO_Marca::Inserir($marca);
		}
		
		public static function Cadastrar_Novo_Modelo(Modelo $modelo) {
			DAO_Modelo::Inserir($modelo);
		}
		
		public static function Verificar_Limite_Nova_Marca() {
			return true;
		}
		
		public static function Verificar_Limite_Novo_Modelo() {
			return true;
		}
		
		public static function Salvar_Imagem_TMP($arquivo) {
			$imagens = new Gerenciar_Imagens();
			
			$imagens->Armazenar_Imagem_Temporaria($arquivo);
			
			if (empty($_SESSION['imagens_tmp'][1])) {
				$_SESSION['imagens_tmp'][1] = $imagens->get_nome();
			} else if (empty($_SESSION['imagens_tmp'][2])) {
				$_SESSION['imagens_tmp'][2] = $imagens->get_nome();
			} else if (empty($_SESSION['imagens_tmp'][3])) {
				$_SESSION['imagens_tmp'][3] = $imagens->get_nome();
			}
			
			return $imagens::Gerar_Data_URL($imagens->get_caminho()."-400x300.".$imagens->get_extensao());
		}
		
		public static function Deletar_Imagem($num_img) {
			if (isset($_SESSION['imagens_tmp'])) {
				if (isset($_SESSION['imagens_tmp'][$num_img]) OR $num_img == 123) {
					$imagens_tmp = $_SESSION['imagens_tmp'];
					$imagens = new Gerenciar_Imagens();
					
					if ($num_img == 123) {
						if (isset($imagens_tmp[1])) {
							$imagens->Deletar_Imagem_Temporaria($imagens_tmp[1]);
						}
						if (isset($imagens_tmp[2])) {
							$imagens->Deletar_Imagem_Temporaria($imagens_tmp[2]);
						}
						if (isset($imagens_tmp[3])) {
							$imagens->Deletar_Imagem_Temporaria($imagens_tmp[3]);
						}
						
						unset($imagens_tmp);
					} else if ($num_img == 1) {
						$imagens->Deletar_Imagem_Temporaria($imagens_tmp[1]);
						
						if (isset($imagens_tmp[2])) {
							$imagens_tmp[1] = $imagens_tmp[2];
							
							if (isset($imagens_tmp[3])) {
								$imagens_tmp[2] = $imagens_tmp[3];
								unset($imagens_tmp[3]);
							} else {
								unset($imagens_tmp[2]);
							}
						} else {
							unset($imagens_tmp[1]);
						}
					} else if ($num_img == 2) {
						$imagens->Deletar_Imagem_Temporaria($imagens_tmp[2]);
						
						if (isset($imagens_tmp[3])) {
							$imagens_tmp[2] = $imagens_tmp[3];
							unset($imagens_tmp[3]);
						} else {
							unset($imagens_tmp[2]);
						}
					} else if ($num_img == 3) {
						$imagens->Deletar_Imagem_Temporaria($imagens_tmp[3]);
						
						unset($imagens_tmp[3]);
					} else {
						$imagens->Deletar_Imagem_Temporaria($num_img);
						
						unset($imagens_tmp[$num_img]);
					}
					
					if (isset($imagens_tmp)) {
						if (count($imagens_tmp) > 0) {
							$_SESSION['imagens_tmp'] = $imagens_tmp;
						} else {
							unset($_SESSION['imagens_tmp']);
						}
					}
				}
			}
		}

		public static function Pegar_Imagem_URL($nome_imagem) {
			$imagens = new Gerenciar_Imagens();
			
			$caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-400x300");
			
			if (isset($caminho_imagem)) {
				return $imagens::Gerar_Data_URL($caminho_imagem);
			} else {
				return "/resources/img/imagem_Indisponivel.png";
			}
		}
		
		public static function Buscar_Categorias() {
			return DAO_Categoria::BuscarTodos();
		}
		
		public static function Buscar_Marcas_Por_Categoria($id_categoria) {
			return DAO_Marca::Buscar_Por_ID_Categorai($id_categoria);
		}
		
		public static function Buscar_Modelos_Por_Marca($id_marca) {
			return DAO_Modelo::Buscar_Por_ID_Marca($id_marca);
		}
		
		public static function Buscar_Versoes_Por_Modelo($id_modelo) {
			return DAO_Versao::Buscar_Por_ID_Modelo($id_modelo);
		}
		
		public static function Buscar_Categoria_Por_Id($id_categoria) {
			return DAO_Categoria::BuscarPorCOD($id_categoria);
		}
		
		public static function Buscar_Marca_Por_Id($id_marca) {
			return DAO_Marca::BuscarPorCOD($id_marca);
		}
		
		public static function Buscar_Modelo_Por_Id($id_modelo) {
			return DAO_Modelo::BuscarPorCOD($id_modelo);
		}
		
		public static function Buscar_Versao_Por_Id($id_versao) {
			return DAO_Versao::BuscarPorCOD($id_versao);
		}
		
		public static function Buscar_Status_Pecas() {
			return DAO_Status_Peca::BuscarTodos();
		}
		
		public static function Buscar_Categoria_Id_Por_Marca($id_marca) {
			return DAO_Marca::Buscar_Categoria_Id($id_marca);
		}
		
		public static function Buscar_Marca_Id_Por_Modelo($id_modelo) {
			return DAO_Modelo::Buscar_Marca_Id($id_modelo);
		}
		
		public static function Buscar_Modelo_Id_Por_Versao($id_versao) {
			return DAO_Versao::Buscar_Modelo_Id($id_versao);
		}
		
		public static function Buscar_Categorias_Compativeis($id_categoria) {
			return DAO_Categoria_Compativel::BuscarPorCOD($id_categoria);
		}
		
		public static function Buscar_Marcas_Compativeis($id_marca) {
			return DAO_Marca_Compativel::BuscarPorCOD($id_marca);
		}
		
		public static function Buscar_Modelos_Compativeis($id_modelo) {
			return DAO_Modelo_Compativel::BuscarPorCOD($id_modelo);
		}
		
		public static function Buscar_Versoes_Compativeis($id_versao) {
			return DAO_Versao_Compativel::BuscarPorCOD($id_versao);
		}
    }
?>