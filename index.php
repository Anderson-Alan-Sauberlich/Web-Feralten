<?php
	
	require_once('config.php');
	require_once('vendor/autoload.php');
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	$app = new \Slim\App();
	
	$app->group('/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$inicio = new application\controller\Inicio();
			
			$inicio->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/menu-filtro/', function() use ($app) {
		$app->get('cidades/', function(Request $request, Response $response, $args) use ($app) {
			$menu_filtro = new application\controller\include_page\menu\Filtro();
			
			if (isset($_GET['estado'])) {
				$menu_filtro->set_estado($_GET['estado']);
			}
			
			$menu_filtro->Retornar_Cidades_Por_Estado();
			
			return $response;
		});
	});
		
	$app->group('/menu-pesquisa/', function() use ($app) {
		$app->get('marca/', function(Request $request, Response $response, $args) use ($app) {
			$menu_pesquisa = new application\controller\include_page\menu\Pesquisa();
			
			if (isset($_GET['categoria'])) {
				$menu_pesquisa->set_categoria($_GET['categoria']);
			}
			
			$menu_pesquisa->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelo/', function(Request $request, Response $response, $args) use ($app) {
			$menu_pesquisa = new application\controller\include_page\menu\Pesquisa();
			
			if (isset($_GET['marca'])) {
				$menu_pesquisa->set_marca($_GET['marca']);
			}
			
			$menu_pesquisa->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
		
		$app->get('versao/', function(Request $request, Response $response, $args) use ($app) {
			$menu_pesquisa = new application\controller\include_page\menu\Pesquisa();
			
			if (isset($_GET['modelo'])) {
				$menu_pesquisa->set_modelo($_GET['modelo']);
			}
			
			$menu_pesquisa->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
	});
	
	$app->group('/usuario/login/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$login = new application\controller\usuario\Login();
			
			$login->Carregar_Pagina();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$login = new application\controller\usuario\Login();
			
			$login->set_email(isset($_POST['email']) ? $_POST['email'] : null);
			
			$login->set_senha(isset($_POST['password']) ? $_POST['password'] : null);
			
			$login->set_manter_login(isset($_POST['manter_login']) ? true : null);
			
			$resposta = $login->Autenticar_Usuario_Login();
			
			if ($resposta) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('sair/', function(Request $request, Response $response, $args) use ($app) {
			$login = new application\controller\usuario\Login();
			
			$login->set_logout(isset($_GET['logout']) ? $_GET['logout'] : null);
			
			$login->LogOut();
			
			return $response->withRedirect('/usuario/login/');
		});
	});
	
	$app->group('/usuario/cadastro/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$cadastro = new application\controller\usuario\Cadastro();
			
			$cadastro->Carregar_Pagina();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$cadastro = new application\controller\usuario\Cadastro();
				
			$cadastro->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
			
			$cadastro->set_email(isset($_POST['email']) ? $_POST['email'] : null);
			
			$cadastro->set_confemail(isset($_POST['confemail']) ? $_POST['confemail'] : null);
			
			$cadastro->set_senha(isset($_POST['senha']) ? $_POST['senha'] : null);
			
			$resposta = $cadastro->Cadastrar_Usuario();
			
			if ($resposta) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$perfil = new application\controller\usuario\meu_perfil\Perfil();
			
			$resposta = $perfil->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/pecas/cadastrar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			$resposta = $cadastrar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('compatibilidade/', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			if (isset($_GET['categoria'])) {
				$cadastrar->set_categoria($_GET['categoria']);
			}
			
			if (isset($_GET['marca'])) {
				$cadastrar->set_marca($_GET['marca']);
			}
			
			if (isset($_GET['modelo'])) {
				$cadastrar->set_modelo($_GET['modelo']);
			}
			
			if (isset($_GET['versao'])) {
				$cadastrar->set_versao($_GET['versao']);
			}
			
			$cadastrar->Carregar_Compatibilidade();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			$cadastrar->set_categoria(isset($_POST['categoria']) ? $_POST['categoria'] : null);
			
			$cadastrar->set_marca(isset($_POST['marca']) ? $_POST['marca'] : null);
			
			$cadastrar->set_modelo(isset($_POST['modelo']) ? $_POST['modelo'] : null);
			
			$cadastrar->set_versao(isset($_POST['versao']) ? $_POST['versao'] : null);
			
			$cadastrar->set_descricao(isset($_POST['descricao']) ? $_POST['descricao'] : null);
			
			$cadastrar->set_estado_uso(isset($_POST['estado_uso']) ? $_POST['estado_uso'] : null);
			
			$cadastrar->set_preferencia_entrega(isset($_POST['preferencia_entrega']) ? $_POST['preferencia_entrega'] : null);
			
			$cadastrar->set_fabricante(isset($_POST['fabricante']) ? $_POST['fabricante'] : null);
			
			$cadastrar->set_peca(isset($_POST['peca']) ? $_POST['peca'] : null);
			
			$cadastrar->set_serie(isset($_POST['serie']) ? $_POST['serie'] : null);
			
			$cadastrar->set_preco(isset($_POST['preco']) ? $_POST['preco'] : null);
			
			$cadastrar->set_prioridade(isset($_POST['prioridade']) ? $_POST['prioridade'] : null);
			
			$resposta = $cadastrar->Verificar_Evento();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			if (isset($_FILES['imagem1'])) {
				$cadastrar->set_imagem($_FILES['imagem1'], 1);
			}
			
			if (isset($_FILES['imagem2'])) {
				$cadastrar->set_imagem($_FILES['imagem2'], 2);
			}
			
			if (isset($_FILES['imagem3'])) {
				$cadastrar->set_imagem($_FILES['imagem3'], 3);
			}
			
			$cadastrar->Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->delete('imagem/{img}', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			$cadastrar->Deletar_Imagem($args['img']);
			
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/pecas/visualizar/', function() use ($app) {
		$app->group('em/', function() use ($app) {
			$app->get('{estado}/{cidade}/[{categoria}/[{marca}/[{modelo}/[{versao}/]]]]', function(Request $request, Response $response, $args) use ($app) {
				$visualizar = new application\controller\usuario\meu_perfil\pecas\Visualizar();
				
				if (isset($args['estado'])) {
					$visualizar->set_estado_uf($args['estado']);
				}
				
				if (isset($args['cidade'])) {
					$visualizar->set_cidade_url($args['cidade']);
				}
				
				if (isset($args['categoria'])) {
					$visualizar->set_categoria_url($args['categoria']);
				}
				
				if (isset($args['marca'])) {
					$visualizar->set_marca_url($args['marca']);
				}
				
				if (isset($args['modelo'])) {
					$visualizar->set_modelo_url($args['modelo']);
				}
				
				if (isset($args['versao'])) {
					$visualizar->set_versao_url($args['versao']);
				}
				
				if (isset($_GET['ano_de'])) {
					$visualizar->set_ano_de($_GET['ano_de']);
				}
				
				if (isset($_GET['ano_ate'])) {
					$visualizar->set_ano_ate($_GET['ano_ate']);
				}
				
				if (isset($_GET['peca'])) {
					$visualizar->set_peca_nome($_GET['peca']);
				}
				
				if (isset($_GET['pagina'])) {
					$visualizar->set_pagina($_GET['pagina']);
				}
				
				if (isset($_GET['ordem_preco'])) {
					$visualizar->set_ordem_preco($_GET['ordem_preco']);
				}
				
				if (isset($_GET['ordem_data'])) {
					$visualizar->set_ordem_data($_GET['ordem_data']);
				}
				
				if (isset($_GET['estado_uso'])) {
					$visualizar->set_estado_uso_url($_GET['estado_uso']);
				}
				
				if (isset($_GET['preferencia_entrega'])) {
					$visualizar->set_preferencia_entrega_url($_GET['preferencia_entrega']);
				}
				
				$resposta = $visualizar->Carregar_Pagina();
				
				if ($resposta === false) {
					return $response->withRedirect('/usuario/login/');
				} else if ($resposta === 'erro') {
					return $response->withRedirect('/usuario/meu-perfil/pecas/visualizar/');
				} else if ($resposta != 1) {
					return $response->withRedirect('/usuario/meu-perfil/');
				} else {
					return $response;
				}
			});
		});
		
		$app->group('', function() use ($app) {
			$app->get('[{categoria}/[{marca}/[{modelo}/[{versao}/]]]]', function(Request $request, Response $response, $args) use ($app) {
				$visualizar = new application\controller\usuario\meu_perfil\pecas\Visualizar();
				
				if (isset($args['categoria'])) {
					$visualizar->set_categoria_url($args['categoria']);
				}
				
				if (isset($args['marca'])) {
					$visualizar->set_marca_url($args['marca']);
				}
				
				if (isset($args['modelo'])) {
					$visualizar->set_modelo_url($args['modelo']);
				}
				
				if (isset($args['versao'])) {
					$visualizar->set_versao_url($args['versao']);
				}
				
				if (isset($_GET['ano_de'])) {
					$visualizar->set_ano_de($_GET['ano_de']);
				}
				
				if (isset($_GET['ano_ate'])) {
					$visualizar->set_ano_ate($_GET['ano_ate']);
				}
				
				if (isset($_GET['peca'])) {
					$visualizar->set_peca_nome($_GET['peca']);
				}
				
				if (isset($_GET['pagina'])) {
					$visualizar->set_pagina($_GET['pagina']);
				}
				
				if (isset($_GET['ordem_preco'])) {
					$visualizar->set_ordem_preco($_GET['ordem_preco']);
				}
				
				if (isset($_GET['ordem_data'])) {
					$visualizar->set_ordem_data($_GET['ordem_data']);
				}
				
				if (isset($_GET['estado_uso'])) {
					$visualizar->set_estado_uso_url($_GET['estado_uso']);
				}
				
				if (isset($_GET['preferencia_entrega'])) {
					$visualizar->set_preferencia_entrega_url($_GET['preferencia_entrega']);
				}
				
				$resposta = $visualizar->Carregar_Pagina();
				
				if ($resposta === false) {
					return $response->withRedirect('/usuario/login/');
				} else if ($resposta === 'erro') {
					return $response->withRedirect('/usuario/meu-perfil/pecas/visualizar/');
				} else if ($resposta != 1) {
					return $response->withRedirect('/usuario/meu-perfil/');
				} else {
					return $response;
				}
			});
		});
	});
	
	$app->group('/usuario/meu-perfil/pecas/atualizar/', function() use ($app) {
		$app->get('compatibilidade/', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\pecas\Atualizar();
			
			if (isset($_GET['categoria'])) {
				$atualizar->set_categoria($_GET['categoria']);
			}
			
			if (isset($_GET['marca'])) {
				$atualizar->set_marca($_GET['marca']);
			}
			
			if (isset($_GET['modelo'])) {
				$atualizar->set_modelo($_GET['modelo']);
			}
			
			if (isset($_GET['versao'])) {
				$atualizar->set_versao($_GET['versao']);
			}
			
			$atualizar->Carregar_Compatibilidade();
			
			return $response;
		});
		
		$app->get('[{peca}/]', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\pecas\Atualizar();
			
			$atualizar->set_peca_id(isset($args['peca']) ? $args['peca'] : null);
			
			$resposta = $atualizar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta === 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else if ($resposta === 'erro') {
				return $response->withRedirect('/usuario/meu-perfil/pecas/visualizar/');
			} else {
				return $response;
			}
		});
		
		$app->delete('imagem/{img}', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\pecas\Atualizar();
			
			$atualizar->Deletar_Imagem($args['img']);
			
			return $response;
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\pecas\Atualizar();
			
			if (isset($_FILES['imagem1'])) {
				$atualizar->set_imagem($_FILES['imagem1'], 1);
			}
			
			if (isset($_FILES['imagem2'])) {
				$atualizar->set_imagem($_FILES['imagem2'], 2);
			}
			
			if (isset($_FILES['imagem3'])) {
				$atualizar->set_imagem($_FILES['imagem3'], 3);
			}
			
			$atualizar->Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->post('[{peca}/]', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\pecas\Atualizar();
			
			$atualizar->set_categoria(isset($_POST['categoria']) ? $_POST['categoria'] : null);
			
			$atualizar->set_marca(isset($_POST['marca']) ? $_POST['marca'] : null);
			
			$atualizar->set_modelo(isset($_POST['modelo']) ? $_POST['modelo'] : null);
			
			$atualizar->set_versao(isset($_POST['versao']) ? $_POST['versao'] : null);
			
			$atualizar->set_descricao(isset($_POST['descricao']) ? $_POST['descricao'] : null);
			
			$atualizar->set_estado_uso(isset($_POST['estado_uso']) ? $_POST['estado_uso'] : null);
			
			$atualizar->set_preferencia_entrega(isset($_POST['preferencia_entrega']) ? $_POST['preferencia_entrega'] : null);
			
			$atualizar->set_fabricante(isset($_POST['fabricante']) ? $_POST['fabricante'] : null);
			
			$atualizar->set_peca(isset($_POST['peca']) ? $_POST['peca'] : null);
			
			$atualizar->set_serie(isset($_POST['serie']) ? $_POST['serie'] : null);
			
			$atualizar->set_preco(isset($_POST['preco']) ? $_POST['preco'] : null);
			
			$atualizar->set_prioridade(isset($_POST['prioridade']) ? $_POST['prioridade'] : null);
			
			$atualizar->set_peca_id(isset($args['peca']) ? $args['peca'] : null);
			
			$resposta = $atualizar->Verificar_Evento();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta === 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else if ($resposta === 'erro') {
				return $response->withRedirect('/usuario/meu-perfil/pecas/visualizar/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/financeiro/boleto-atual/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$boleto_atual = new application\controller\usuario\meu_perfil\financeiro\Boleto_Atual();
			
			$resposta = $boleto_atual->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/financeiro/boletos-pagos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$boletos_pagos = new application\controller\usuario\meu_perfil\financeiro\Boletos_Pagos();
			
			$resposta = $boletos_pagos->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/financeiro/meu-plano/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$meu_plano = new application\controller\usuario\meu_perfil\financeiro\Meu_Plano();
			
			$resposta = $meu_plano->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/atualizar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
			
			$resposta = $atualizar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->post('usuario/', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
			
			$atualizar->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
			
			$atualizar->set_fone1(isset($_POST['fone1']) ? $_POST['fone1'] : null);
			
			$atualizar->set_fone2(isset($_POST['fone2']) ? $_POST['fone2'] : null);
			
			$atualizar->set_email(isset($_POST['email']) ? $_POST['email'] : null);
			
			$atualizar->set_confemail(isset($_POST['confemail']) ? $_POST['confemail'] : null);
			
			$atualizar->set_email_alternativo(isset($_POST['email_alternativo']) ? $_POST['email_alternativo'] : null);
			
			$resposta = $atualizar->Verificar_Evento();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->post('entidade/', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
			
			$atualizar->set_cpf_cnpj(isset($_POST['cpf_cnpj']) ? $_POST['cpf_cnpj'] : null);
			
			$atualizar->set_site(isset($_POST['site']) ? $_POST['site'] : null);
			
			$atualizar->set_nome_comercial(isset($_POST['nome_comercial']) ? $_POST['nome_comercial'] : null);
			
			$resposta = $atualizar->Verificar_Evento();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
				
			$atualizar->Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->delete('imagem/', function(Request $request, Response $response, $args) use ($app) {
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
				
			$atualizar->Deletar_Imagem();
			
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/alterar-senha/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$alterar_senha = new application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha();
			
			$resposta = $alterar_senha->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$alterar_senha = new application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha();
			
			$alterar_senha->set_senha_antiga(isset($_POST['senha_antiga']) ? $_POST['senha_antiga'] : null);
			
			$alterar_senha->set_senha_nova(isset($_POST['senha_nova']) ? $_POST['senha_nova'] : null);
			
			$alterar_senha->set_senha_confnova(isset($_POST['senha_confnova']) ? $_POST['senha_confnova'] : null);
			
			$resposta = $alterar_senha->Atualizar_Senha_Usuario();
			
			if ($resposta === 'certo') {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/enderecos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$enderecos = new application\controller\usuario\meu_perfil\meus_dados\Enderecos();
			
			$resposta = $enderecos->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('cidades/', function(Request $request, Response $response, $args) use ($app) {
			$enderecos = new application\controller\usuario\meu_perfil\meus_dados\Enderecos();
			
			if (isset($_GET['estado'])) {
				$enderecos->set_estado($_GET['estado']);
			}
			
			$enderecos->Retornar_Cidades_Por_Estado();
			
			return $response;
		});

		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$enderecos = new application\controller\usuario\meu_perfil\meus_dados\Enderecos();
			
			$enderecos->set_cidade(isset($_POST['cidade']) ? $_POST['cidade'] : null);
			
			$enderecos->set_estado(isset($_POST['estado']) ? $_POST['estado'] : null);
			
			$enderecos->set_numero(isset($_POST['numero']) ? $_POST['numero'] : null);
			
			$enderecos->set_cep(isset($_POST['cep']) ? $_POST['cep'] : null);
			
			$enderecos->set_bairro(isset($_POST['bairro']) ? $_POST['bairro'] : null);
			
			$enderecos->set_rua(isset($_POST['rua']) ? $_POST['rua'] : null);
			
			$enderecos->set_complemento(isset($_POST['complemento']) ? $_POST['complemento'] : null);
			
			$resposta = $enderecos->Atualizar_Endereco();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/concluir/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
			
			$resposta = $concluir->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 0) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('cidades/', function(Request $request, Response $response, $args) use ($app) {
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
			
			if (isset($_GET['estado'])) {
				$concluir->set_estado($_GET['estado']);
			}
			
			$concluir->Retornar_Cidades_Por_Estado();
			
			return $response;
		});
		
		$app->delete('imagem/', function(Request $request, Response $response, $args) use ($app) {
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
				
			$concluir->Deletar_Imagem();
			
			return $response;
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
				
			$concluir->Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
			
			$concluir->set_fone1(isset($_POST['fone1']) ? $_POST['fone1'] : null);
			
			$concluir->set_fone2(isset($_POST['fone2']) ? $_POST['fone2'] : null);
			
			$concluir->set_email_alternativo(isset($_POST['email_alternativo']) ? $_POST['email_alternativo'] : null);
			
			$concluir->set_cidade(isset($_POST['cidade']) ? $_POST['cidade'] : null);
			
			$concluir->set_estado(isset($_POST['estado']) ? $_POST['estado'] : null);
			
			$concluir->set_numero(isset($_POST['numero']) ? $_POST['numero'] : null);
			
			$concluir->set_cep(isset($_POST['cep']) ? $_POST['cep'] : null);
			
			$concluir->set_bairro(isset($_POST['bairro']) ? $_POST['bairro'] : null);
			
			$concluir->set_rua(isset($_POST['rua']) ? $_POST['rua'] : null);
			
			$concluir->set_complemento(isset($_POST['complemento']) ? $_POST['complemento'] : null);
			
			$concluir->set_cpf_cnpj(isset($_POST['cpf_cnpj']) ? $_POST['cpf_cnpj'] : null);
			
			$concluir->set_site(isset($_POST['site']) ? $_POST['site'] : null);
			
			$concluir->set_nome_comercial(isset($_POST['nome_comercial']) ? $_POST['nome_comercial'] : null);
			
			$resposta = $concluir->Concluir_Cadastro();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta === 'certo') {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/quem-somos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$quem_somos = new application\controller\Quem_Somos();
			
			$quem_somos->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/usuario/recuperar-senha/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$recuperar_senha = new application\controller\usuario\Recuperar_Senha();
			
			$recuperar_senha->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/documentacao/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$documentacao = new application\controller\Documentacao();
			
			$documentacao->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/perguntas-frequentes/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$perguntas_frequentes = new application\controller\Perguntas_Frequentes();
			
			$perguntas_frequentes->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/apresentacao/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$apresentacao = new application\controller\dicas_de_venda\Apresentacao();
			
			$apresentacao->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/principais/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$principais = new application\controller\dicas_de_venda\Principais();
			
			$principais->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/fale-conosco/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$fale_conosco = new application\controller\Fale_Conosco();
			
			$fale_conosco->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pesquisa-avancada/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$pesquisa_avancada = new application\controller\Pesquisa_Avancada();
			
			$pesquisa_avancada->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/busca-programada/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$busca_programada = new application\controller\pecas\Busca_Programada();
			
			$busca_programada->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/mais-visualizados/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$mais_visualizados = new application\controller\pecas\Mais_Visualizados();
			
			$mais_visualizados->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/venda-segura/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$venda_segura = new application\controller\dicas_de_venda\Venda_Segura();
			
			$venda_segura->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/resultados/', function() use ($app) {
		$app->group('em/', function() use ($app) {
			$app->get('{estado}/{cidade}/[{categoria}/[{marca}/[{modelo}/[{versao}/]]]]', function(Request $request, Response $response, $args) use ($app) {
				$resultados = new application\controller\pecas\Resultados();
				
				if (isset($args['estado'])) {
					$resultados->set_estado_uf($args['estado']);
				}
				
				if (isset($args['cidade'])) {
					$resultados->set_cidade_url($args['cidade']);
				}
				
				if (isset($args['categoria'])) {
					$resultados->set_categoria_url($args['categoria']);
				}
				
				if (isset($args['marca'])) {
					$resultados->set_marca_url($args['marca']);
				}
				
				if (isset($args['modelo'])) {
					$resultados->set_modelo_url($args['modelo']);
				}
				
				if (isset($args['versao'])) {
					$resultados->set_versao_url($args['versao']);
				}
				
				if (isset($_GET['ano_de'])) {
					$resultados->set_ano_de($_GET['ano_de']);
				}
				
				if (isset($_GET['ano_ate'])) {
					$resultados->set_ano_ate($_GET['ano_ate']);
				}
				
				if (isset($_GET['peca'])) {
					$resultados->set_peca_nome($_GET['peca']);
				}
				
				if (isset($_GET['pagina'])) {
					$resultados->set_pagina($_GET['pagina']);
				}
				
				if (isset($_GET['ordem_preco'])) {
					$resultados->set_ordem_preco($_GET['ordem_preco']);
				}
				
				if (isset($_GET['ordem_data'])) {
					$resultados->set_ordem_data($_GET['ordem_data']);
				}
				
				if (isset($_GET['estado_uso'])) {
					$resultados->set_estado_uso_url($_GET['estado_uso']);
				}
				
				if (isset($_GET['preferencia_entrega'])) {
					$resultados->set_preferencia_entrega_url($_GET['preferencia_entrega']);
				}
				
				$resultados->Carregar_Pagina();
				
				return $response;
			});
		});
		
		$app->group('', function() use ($app) {
			$app->get('[{categoria}/[{marca}/[{modelo}/[{versao}/]]]]', function(Request $request, Response $response, $args) use ($app) {
				$resultados = new application\controller\pecas\Resultados();
				
				if (isset($args['categoria'])) {
					$resultados->set_categoria_url($args['categoria']);
				}
				
				if (isset($args['marca'])) {
					$resultados->set_marca_url($args['marca']);
				}
				
				if (isset($args['modelo'])) {
					$resultados->set_modelo_url($args['modelo']);
				}
				
				if (isset($args['versao'])) {
					$resultados->set_versao_url($args['versao']);
				}
				
				if (isset($_GET['ano_de'])) {
					$resultados->set_ano_de($_GET['ano_de']);
				}
				
				if (isset($_GET['ano_ate'])) {
					$resultados->set_ano_ate($_GET['ano_ate']);
				}
				
				if (isset($_GET['peca'])) {
					$resultados->set_peca_nome($_GET['peca']);
				}
				
				if (isset($_GET['pagina'])) {
					$resultados->set_pagina($_GET['pagina']);
				}
				
				if (isset($_GET['ordem_preco'])) {
					$resultados->set_ordem_preco($_GET['ordem_preco']);
				}
				
				if (isset($_GET['ordem_data'])) {
					$resultados->set_ordem_data($_GET['ordem_data']);
				}
				
				if (isset($_GET['estado_uso'])) {
					$resultados->set_estado_uso_url($_GET['estado_uso']);
				}
				
				if (isset($_GET['preferencia_entrega'])) {
					$resultados->set_preferencia_entrega_url($_GET['preferencia_entrega']);
				}
				
				$resultados->Carregar_Pagina();
				
				return $response;
			});
		});
	});
	
	$app->group('/publicidade/experimentar-formatos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$experimentar_formatos = new application\controller\publicidade\Experimentar_Formatos();
			
			$experimentar_formatos->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/admin/login/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$login = new application\controller\admin\Login();
		
			$login->Carregar_Pagina();
		
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$login = new application\controller\admin\Login();
			
			$login->set_usuario(isset($_POST['usuario']) ? $_POST['usuario'] : null);
			
			$login->set_senha(isset($_POST['senha']) ? $_POST['senha'] : null);
			
			$resposta = $login->Login();
			
			if ($resposta) {
				return $response->withRedirect('/admin/controle/base-de-conhecimento/cmmv/cadastrar/');
			} else {
				return $response;
			}
		});
		
		$app->get('sair/', function(Request $request, Response $response, $args) use ($app) {
			$login = new application\controller\admin\Login();
			
			if (isset($_GET['logout'])) {
				$login->set_logout($_GET['logout']);
			}
			
			$login->LogOut();
			
			return $response->withRedirect('/admin/login/');
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/cmmv/cadastrar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			$resposta = $cadastrar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
		
		$app->get('categorias/', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			$cadastrar->Retornar_Categorias();
			
			return $response;
		});
		
		$app->get('marcas/', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			if (isset($_GET['categoria'])) {
				$cadastrar->set_categoria($_GET['categoria']);
			}
			
			$cadastrar->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelos/', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			if (isset($_GET['marca'])) {
				$cadastrar->set_marca($_GET['marca']);
			}
			
			$cadastrar->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
		
		$app->get('versoes/', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			if (isset($_GET['modelo'])) {
				$cadastrar->set_modelo($_GET['modelo']);
			}
			
			$cadastrar->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			if (isset($_POST['categoria'])) {
				$cadastrar->set_categoria($_POST['categoria']);
			}
			
			if (isset($_POST['marca'])) {
				$cadastrar->set_marca($_POST['marca']);
			}
			
			if (isset($_POST['modelo'])) {
				$cadastrar->set_modelo($_POST['modelo']);
			}
			
			if (isset($_POST['versao'])) {
				$cadastrar->set_versao($_POST['versao']);
			}
			
			if (isset($_POST['nome'])) {
				$cadastrar->set_nome($_POST['nome']);
			}
			
			if (isset($_POST['url'])) {
				$cadastrar->set_url($_POST['url']);
			}
			
			$cadastrar->Cadastrar_CMMV();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/cmmv/alterar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			$resposta = $alterar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
		
		$app->get('categorias/', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			$alterar->Retornar_Categorias();
			
			return $response;
		});
		
		$app->get('marcas/', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['categoria'])) {
				$alterar->set_categoria($_GET['categoria']);
			}
			
			$alterar->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelos/', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['marca'])) {
				$alterar->set_marca($_GET['marca']);
			}
			
			$alterar->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
		
		$app->get('versoes/', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['modelo'])) {
				$alterar->set_modelo($_GET['modelo']);
			}
			
			$alterar->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
		
		$app->get('categoria/', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['categoria'])) {
				$alterar->set_categoria($_GET['categoria']);
			}
			
			$alterar->Retornar_Categoria();
			
			return $response;
		});
		
		$app->get('marca/', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['marca'])) {
				$alterar->set_marca($_GET['marca']);
			}
			
			$alterar->Retornar_Marca();
			
			return $response;
		});
		
		$app->get('modelo/', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['modelo'])) {
				$alterar->set_modelo($_GET['modelo']);
			}
			
			$alterar->Retornar_Modelo();
			
			return $response;
		});
		
		$app->get('versao/', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['versao'])) {
				$alterar->set_versao($_GET['versao']);
			}
			
			$alterar->Retornar_Versao();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_POST['categoria'])) {
				$alterar->set_categoria($_POST['categoria']);
			}
			
			if (isset($_POST['marca'])) {
				$alterar->set_marca($_POST['marca']);
			}
			
			if (isset($_POST['modelo'])) {
				$alterar->set_modelo($_POST['modelo']);
			}
			
			if (isset($_POST['versao'])) {
				$alterar->set_versao($_POST['versao']);
			}
			
			if (isset($_POST['nome'])) {
				$alterar->set_nome($_POST['nome']);
			}
			
			if (isset($_POST['url'])) {
				$alterar->set_url($_POST['url']);
			}
			
			$alterar->Alterar_CMMV();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/cmmv/deletar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			$resposta = $deletar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
		
		$app->get('categorias/', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			$deletar->Retornar_Categorias();
			
			return $response;
		});
		
		$app->get('marcas/', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['categoria'])) {
				$deletar->set_categoria($_GET['categoria']);
			}
			
			$deletar->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
			
		$app->get('modelos/', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['marca'])) {
				$deletar->set_marca($_GET['marca']);
			}
			
			$deletar->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
			
		$app->get('versoes/', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['modelo'])) {
				$deletar->set_modelo($_GET['modelo']);
			}
			
			$deletar->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
			
		$app->get('categoria/', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['categoria'])) {
				$deletar->set_categoria($_GET['categoria']);
			}
			
			$deletar->Retornar_Categoria();
			
			return $response;
		});
			
		$app->get('marca/', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['marca'])) {
				$deletar->set_marca($_GET['marca']);
			}
			
			$deletar->Retornar_Marca();
			
			return $response;
		});
			
		$app->get('modelo/', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['modelo'])) {
				$deletar->set_modelo($_GET['modelo']);
			}
			
			$deletar->Retornar_Modelo();
			
			return $response;
		});
			
		$app->get('versao/', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['versao'])) {
				$deletar->set_versao($_GET['versao']);
			}
			
			$deletar->Retornar_Versao();
			
			return $response;
		});
			
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_POST['categoria'])) {
				$deletar->set_categoria($_POST['categoria']);
			}
			
			if (isset($_POST['marca'])) {
				$deletar->set_marca($_POST['marca']);
			}
			
			if (isset($_POST['modelo'])) {
				$deletar->set_modelo($_POST['modelo']);
			}
			
			if (isset($_POST['versao'])) {
				$deletar->set_versao($_POST['versao']);
			}
			
			if (isset($_POST['nome'])) {
				$deletar->set_nome($_POST['nome']);
			}
			
			if (isset($_POST['url'])) {
				$deletar->set_url($_POST['url']);
			}
			
			$deletar->Deletar_CMMV();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/compatibilidade/cadastrar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\compatibilidade\Cadastrar();
			
			$resposta = $cadastrar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/compatibilidade/alterar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$alterar = new application\controller\admin\controle\base_de_conhecimento\compatibilidade\Alterar();
			
			$resposta = $alterar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/compatibilidade/deletar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			$deletar = new application\controller\admin\controle\base_de_conhecimento\compatibilidade\Deletar();
			
			$resposta = $deletar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/admin/controle/usuario/alterar-senha/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			
			return $response;
		});
	});
	
	$app->run();
?>