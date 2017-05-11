<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	require_once('vendor/autoload.php');
	require_once('config.php');
	
	$app = new \Slim\App();
	
	$app->group('/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pagina_inicial.php');
			
			$pagina_inicial = new application\controller\Pagina_Inicial();
			
			$pagina_inicial->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/menu-pesquisa/', function() use ($app) {
		$app->get('marca/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu/pesquisa.php');
			
			$menu_pesquisa = new application\controller\include_page\menu\Pesquisa();
			
			if (isset($_GET['categoria'])) {
				$menu_pesquisa->set_categoria($_GET['categoria']);
			}
			
			$menu_pesquisa->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelo/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu/pesquisa.php');
			
			$menu_pesquisa = new application\controller\include_page\menu\Pesquisa();
			
			if (isset($_GET['marca'])) {
				$menu_pesquisa->set_marca($_GET['marca']);
			}
			
			$menu_pesquisa->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
		
		$app->get('versao/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu/pesquisa.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			$login = new application\controller\usuario\Login();
			
			$login->Carregar_Pagina();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			$login = new application\controller\usuario\Login();
			
			$login->set_logout(isset($_GET['logout']) ? $_GET['logout'] : null);
			
			$login->LogOut();
			
			return $response->withRedirect('/usuario/login/');
		});
	});
	
	$app->group('/usuario/cadastro/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/cadastro.php');
			
			$cadastro = new application\controller\usuario\Cadastro();
			
			$cadastro->Carregar_Pagina();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/cadastro.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/perfil.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			if (isset($_POST['categoria'])) {
				$cadastrar->set_categoria($_POST['categoria']);
			}
			
			if (isset($_POST['marca'])) {
				$cadastrar->set_marca($_GET['marca']);
			}
			
			if (isset($_POST['modelo'])) {
				$cadastrar->set_modelo($_POST['modelo']);
			}
			
			if (isset($_POST['versao'])) {
				$cadastrar->set_versao($_POST['versao']);
			}
			
			if (isset($_POST['descricao'])) {
				$cadastrar->set_descricao($_POST['descricao']);
			}
			
			if (isset($_POST['status'])) {
				$cadastrar->set_status($_POST['status']);
			}
			
			if (isset($_POST['preferencia_entrega'])) {
				$cadastrar->set_preferencia_entrega($_POST['preferencia_entrega']);
			}
			
			if (isset($_POST['fabricante'])) {
				$cadastrar->set_fabricante($_POST['fabricante']);
			}
			
			if (isset($_POST['peca'])) {
				$cadastrar->set_peca($_POST['peca']);
			}
			
			if (isset($_POST['serie'])) {
				$cadastrar->set_serie($_POST['serie']);
			}
			
			if (isset($_POST['preco'])) {
				$cadastrar->set_preco($_POST['preco']);
			}
			
			if (isset($_POST['prioridade'])) {
				$cadastrar->set_prioridade($_POST['prioridade']);
			}
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
				
			$cadastrar->Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->delete('imagem/{img}', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			$cadastrar->Deletar_Imagem($args['img']);
			
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/pecas/visualizar/', function() use ($app) {
		$app->get('[{categoria}/[{marca}/[{modelo}/[{versao}/]]]]', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
			
			$visualizar = new application\controller\usuario\meu_perfil\pecas\Visualizar();
			
			if (isset($args['categoria'])) {
				$visualizar->set_categoria($args['categoria']);
			}
			
			if (isset($args['marca'])) {
				$visualizar->set_marca($args['marca']);
			}
			
			if (isset($args['modelo'])) {
				$visualizar->set_modelo($args['modelo']);
			}
			
			if (isset($args['versao'])) {
				$visualizar->set_versao($args['versao']);
			}
			
			if (isset($_GET['ano_de'])) {
				$visualizar->set_ano_de($_GET['ano_de']);
			}
			
			if (isset($_GET['ano_ate'])) {
				$visualizar->set_ano_ate($_GET['ano_ate']);
			}
			
			if (isset($_GET['peca'])) {
				$visualizar->set_peca($_GET['peca']);
			}
			
			if (isset($_GET['pagina'])) {
				$visualizar->set_pagina($_GET['pagina']);
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
	
	$app->group('/usuario/meu-perfil/pecas/atualizar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/atualizar.php');
		
			$atualizar = new application\controller\usuario\meu_perfil\pecas\Atualizar();
			
			$resposta = $atualizar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/financeiro/boleto-atual/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/financeiro/boleto_atual.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/financeiro/boletos_pagos.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/financeiro/meu_plano.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
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
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
			
			if (isset($_POST['nome'])) {
				$atualizar->set_nome($_POST['nome']);
			}
			
			if (isset($_POST['fone1'])) {
				$atualizar->set_fone1($_POST['fone1']);
			}
			
			if (isset($_POST['fone2'])) {
				$atualizar->set_fone2($_POST['fone2']);
			}
			
			if (isset($_POST['email'])) {
				$atualizar->set_email($_POST['email']);
			}
			
			if (isset($_POST['confemail'])) {
				$atualizar->set_confemail($_POST['confemail']);
			}
			
			if (isset($_POST['email_alternativo'])) {
				$atualizar->set_email_alternativo($_POST['email_alternativo']);
			}
			
			if (isset($_POST['cpf_cnpj'])) {
				$atualizar->set_cpf_cnpj($_POST['cpf_cnpj']);
			}
			
			if (isset($_POST['site'])) {
				$atualizar->set_site($_POST['site']);
			}
			
			if (isset($_POST['nome_comercial'])) {
				$atualizar->set_nome_comercial($_POST['nome_comercial']);
			}
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
				
			$atualizar->Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->delete('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
				
			$atualizar->Deletar_Imagem();
			
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/alterar-senha/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php');
			
			$alterar_senha = new application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha();
			
			$resposta = $alterar_senha->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php');
			
			$alterar_senha = new application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha();
			
			if (isset($_POST['senha_antiga'])) {
				$alterar_senha->set_senha_antiga($_POST['senha_antiga']);
			}
			
			if (isset($_POST['senha_nova'])) {
				$alterar_senha->set_senha_nova($_POST['senha_nova']);
			}
			
			if (isset($_POST['senha_confnova'])) {
				$alterar_senha->set_senha_confnova($_POST['senha_confnova']);
			}
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			$enderecos = new application\controller\usuario\meu_perfil\meus_dados\Enderecos();
			
			if (isset($_GET['estado'])) {
				$enderecos->set_estado($_GET['estado']);
			}
			
			$enderecos->Retornar_Cidades_Por_Estado();
			
			return $response;
		});

		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			$enderecos = new application\controller\usuario\meu_perfil\meus_dados\Enderecos();
			
			if (isset($_POST['cidade'])) {
				$enderecos->set_cidade($_POST['cidade']);
			}
			
			if (isset($_POST['estado'])) {
				$enderecos->set_estado($_POST['estado']);
			}
			
			if (isset($_POST['numero'])) {
				$enderecos->set_numero($_POST['numero']);
			}
			
			if (isset($_POST['cep'])) {
				$enderecos->set_cep($_POST['cep']);
			}
			
			if (isset($_POST['bairro'])) {
				$enderecos->set_bairro($_POST['bairro']);
			}
			
			if (isset($_POST['rua'])) {
				$enderecos->set_rua($_POST['rua']);
			}
			
			if (isset($_POST['complemento'])) {
				$enderecos->set_complemento($_POST['complemento']);
			}
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
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
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
			
			if (isset($_GET['estado'])) {
				$concluir->set_estado($_GET['estado']);
			}
			
			$concluir->Retornar_Cidades_Por_Estado();
			
			return $response;
		});
		
		$app->delete('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
				
			$concluir->Deletar_Imagem();
			
			return $response;
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
				
			$concluir->Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
			
			if (isset($_POST['fone1'])) {
				$concluir->set_fone1($_POST['fone1']);
			}
			
			if (isset($_POST['fone2'])) {
				$concluir->set_fone2($_POST['fone2']);
			}
			
			if (isset($_POST['email_alternativo'])) {
				$concluir->set_email_alternativo($_POST['email_alternativo']);
			}
			
			if (isset($_POST['cidade'])) {
				$concluir->set_cidade($_POST['cidade']);
			}
			
			if (isset($_POST['estado'])) {
				$concluir->set_estado($_POST['estado']);
			}
			
			if (isset($_POST['numero'])) {
				$concluir->set_numero($_POST['numero']);
			}
			
			if (isset($_POST['cep'])) {
				$concluir->set_cep($_POST['cep']);
			}
			
			if (isset($_POST['bairro'])) {
				$concluir->set_bairro($_POST['bairro']);
			}
			
			if (isset($_POST['rua'])) {
				$concluir->set_rua($_POST['rua']);
			}
			
			if (isset($_POST['complemento'])) {
				$concluir->set_complemento($_POST['complemento']);
			}
			
			if (isset($_POST['cpf_cnpj'])) {
				$concluir->set_cpf_cnpj($_POST['cpf_cnpj']);
			}
			
			if (isset($_POST['site'])) {
				$concluir->set_site($_POST['site']);
			}
			
			if (isset($_POST['nome_comercial'])) {
				$concluir->set_nome_comercial($_POST['nome_comercial']);
			}
			
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
			require_once(RAIZ.'/application/controller/quem_somos.php');
			
			$quem_somos = new application\controller\Quem_Somos();
			
			$quem_somos->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/usuario/recuperar-senha/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/recuperar_senha.php');
			
			$recuperar_senha = new application\controller\usuario\Recuperar_Senha();
			
			$recuperar_senha->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/documentacao/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/documentacao.php');
			
			$documentacao = new application\controller\Documentacao();
			
			$documentacao->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/perguntas-frequentes/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/perguntas_frequentes.php');
			
			$perguntas_frequentes = new application\controller\Perguntas_Frequentes();
			
			$perguntas_frequentes->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/apresentacao/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/apresentacao.php');
				
			$apresentacao = new application\controller\dicas_de_venda\Apresentacao();
			
			$apresentacao->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/principais/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/principais.php');
			
			$principais = new application\controller\dicas_de_venda\Principais();
			
			$principais->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/contato/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/contato.php');
			
			$contato = new application\controller\Contato();
			
			$contato->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pesquisa-avancada/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pesquisa_avancada.php');
			
			$pesquisa_avancada = new application\controller\Pesquisa_Avancada();
			
			$pesquisa_avancada->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/busca-programada/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/busca_programada.php');
			
			$busca_programada = new application\controller\pecas\Busca_Programada();
			
			$busca_programada->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/mais-visualizados/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/mais_visualizados.php');
			
			$mais_visualizados = new application\controller\pecas\Mais_Visualizados();
			
			$mais_visualizados->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/venda-segura/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/venda_segura.php');
			
			$venda_segura = new application\controller\dicas_de_venda\Venda_Segura();
			
			$venda_segura->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/resultados/', function() use ($app) {
		$app->get('[{categoria}/[{marca}/[{modelo}/[{versao}/]]]]', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
			
			$resultados = new application\controller\pecas\Resultados();
			
			$resultados->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/publicidade/experimentar-formatos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/publicidade/experimentar_formatos.php');
			
			$experimentar_formatos = new application\controller\publicidade\Experimentar_Formatos();
			
			$experimentar_formatos->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/admin/login/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/login.php');
		
			$login = new application\controller\admin\Login();
		
			$login->Carregar_Pagina();
		
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/login.php');
			
			$login = new application\controller\admin\Login();
			
			if (isset($_POST['usuario'])) {
				$login->set_usuario($_POST['usuario']);
			}
			
			if (isset($_POST['senha'])) {
				$login->set_senha($_POST['senha']);
			}
			
			$resposta = $login->Login();
			
			if ($resposta) {
				return $response->withRedirect('/admin/controle/base-de-conhecimento/cmmv/cadastrar/');
			} else {
				return $response;
			}
		});
		
		$app->get('sair/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/login.php');
			
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
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
			
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			$resposta = $cadastrar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
		
		$app->get('categorias/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
			
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			$cadastrar->Retornar_Categorias();
			
			return $response;
		});
		
		$app->get('marcas/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
			
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			if (isset($_GET['categoria'])) {
				$cadastrar->set_categoria($_GET['categoria']);
			}
			
			$cadastrar->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelos/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
			
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			if (isset($_GET['marca'])) {
				$cadastrar->set_marca($_GET['marca']);
			}
			
			$cadastrar->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
		
		$app->get('versoes/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
			
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			if (isset($_GET['modelo'])) {
				$cadastrar->set_modelo($_GET['modelo']);
			}
			
			$cadastrar->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
			
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
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			$resposta = $alterar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
		
		$app->get('categorias/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			$alterar->Retornar_Categorias();
			
			return $response;
		});
		
		$app->get('marcas/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['categoria'])) {
				$alterar->set_categoria($_GET['categoria']);
			}
			
			$alterar->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelos/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['marca'])) {
				$alterar->set_marca($_GET['marca']);
			}
			
			$alterar->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
		
		$app->get('versoes/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['modelo'])) {
				$alterar->set_modelo($_GET['modelo']);
			}
			
			$alterar->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
		
		$app->get('categoria/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['categoria'])) {
				$alterar->set_categoria($_GET['categoria']);
			}
			
			$alterar->Retornar_Categoria();
			
			return $response;
		});
		
		$app->get('marca/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['marca'])) {
				$alterar->set_marca($_GET['marca']);
			}
			
			$alterar->Retornar_Marca();
			
			return $response;
		});
		
		$app->get('modelo/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['modelo'])) {
				$alterar->set_modelo($_GET['modelo']);
			}
			
			$alterar->Retornar_Modelo();
			
			return $response;
		});
		
		$app->get('versao/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
			$alterar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Alterar();
			
			if (isset($_GET['versao'])) {
				$alterar->set_versao($_GET['versao']);
			}
			
			$alterar->Retornar_Versao();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/alterar.php');
			
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
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			$resposta = $deletar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
		
		$app->get('categorias/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			$deletar->Retornar_Categorias();
			
			return $response;
		});
		
		$app->get('marcas/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['categoria'])) {
				$deletar->set_categoria($_GET['categoria']);
			}
			
			$deletar->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
			
		$app->get('modelos/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['marca'])) {
				$deletar->set_marca($_GET['marca']);
			}
			
			$deletar->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
			
		$app->get('versoes/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['modelo'])) {
				$deletar->set_modelo($_GET['modelo']);
			}
			
			$deletar->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
			
		$app->get('categoria/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['categoria'])) {
				$deletar->set_categoria($_GET['categoria']);
			}
			
			$deletar->Retornar_Categoria();
			
			return $response;
		});
			
		$app->get('marca/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['marca'])) {
				$deletar->set_marca($_GET['marca']);
			}
			
			$deletar->Retornar_Marca();
			
			return $response;
		});
			
		$app->get('modelo/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['modelo'])) {
				$deletar->set_modelo($_GET['modelo']);
			}
			
			$deletar->Retornar_Modelo();
			
			return $response;
		});
			
		$app->get('versao/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			if (isset($_GET['versao'])) {
				$deletar->set_versao($_GET['versao']);
			}
			
			$deletar->Retornar_Versao();
			
			return $response;
		});
			
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
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
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/compatibilidade/cadastrar.php');
			
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
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/compatibilidade/alterar.php');
			
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
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/compatibilidade/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\compatibilidade\Deletar();
			
			$resposta = $deletar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/admin/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->run();
?>