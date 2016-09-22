<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	require_once('config.php');
	require_once('vendor/autoload.php');
	
	$config['displayErrorDetails'] = true;
	
	$app = new \Slim\App(["settings" => $config]);
	
	$app->group('/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/pagina_inicial.php');
			
			application\controller\Pagina_Inicial::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
	});
	
	$app->group('/usuario/login/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			application\controller\usuario\Login::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
		
		$app->post('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			if (application\controller\usuario\Login::Autenticar_Usuario_Login($_POST["email"], $_POST["password"], $_POST['manter_login'])) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response->withRedirect('/usuario/login/');
			}
		});
	});
	
	$app->group('/usuario/cadastro/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/cadastro.php');
			
			application\controller\usuario\Cadastro::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
		
		$app->post('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/cadastro.php');
			
			if (application\controller\usuario\Cadastro::Cadastrar_Usuario()) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response->withRedirect('/usuario/cadastro/');
			}
		});
	});
	
	$app->group('/menu_pesquisa/', function () use ($app) {
		$app->get('marca/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu.php');
			
			application\controller\include_page\Menu::Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelo/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu.php');
			
			application\controller\include_page\Menu::Retornar_Modelos_Por_Marca();
			
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/perfil.php');
			
			application\controller\usuario\meu_perfil\Perfil::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
	});

	$app->group('/usuario/meu-perfil/auto-pecas/cadastrar/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/cadastrar.php');
			
			application\controller\usuario\meu_perfil\auto_pecas\Cadastrar::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
		
		$app->get('compatibilidade/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/cadastrar.php');
			
			application\controller\usuario\meu_perfil\auto_pecas\Cadastrar::Carregar_Compatibilidade();
			
			return $response;
		});
		
		$app->post('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/cadastrar.php');
			
			application\controller\usuario\meu_perfil\auto_pecas\Cadastrar::Verificar_Evento();
			
			return $response->withRedirect('/usuario/meu-perfil/auto-pecas/cadastrar/');
		});
		
		$app->post('imagem/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/cadastrar.php');
			
			application\controller\usuario\meu_perfil\auto_pecas\Cadastrar::Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->delete('imagem/{img}', function (Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/cadastrar.php');
			
			application\controller\usuario\meu_perfil\auto_pecas\Cadastrar::Deletar_Imagem($args['img']);
			
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/auto-pecas/visualizar/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/visualizar.php');
			
			application\controller\usuario\meu_perfil\auto_pecas\Visualizar::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/auto-pecas/atualizar/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/atualizar.php');
		
			application\controller\usuario\meu_perfil\auto_pecas\Atualizar::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/atualizar/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Atualizar::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
		
		$app->post('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Atualizar::Verificar_Evento();
			
			return $response->withRedirect('/usuario/meu-perfil/meus-dados/atualizar/');
		});
		
		$app->post('imagem/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Atualizar::Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->delete('imagem/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Atualizar::Deletar_Imagem();
			
			return $response;
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/alterar-senha/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
		
		$app->post('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php');
			
			if (application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha::Atualizar_Senha_Usuario()) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response->withRedirect('/usuario/meu-perfil/meus-dados/alterar-senha/');
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/enderecos/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Enderecos::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
		
		$app->get('cidades/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Enderecos::Retornar_Cidades_Por_Estado();
			
			return $response;
		});

		$app->post('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Enderecos::Atualizar_Endereco();
			
			return $response->withRedirect('/usuario/meu-perfil/meus-dados/enderecos/');
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/concluir/', function () use ($app) {
		$app->get('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Concluir::Carregar_Pagina();
			echo var_dump($_SESSION);
			return $response;
		});
		
		$app->get('cidades/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Concluir::Retornar_Cidades_Por_Estado();
			
			return $response;
		});
		
		$app->delete('imagem/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Concluir::Deletar_Imagem();
			
			return $response;
		});
		
		$app->post('imagem/', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			application\controller\usuario\meu_perfil\meus_dados\Concluir::Salvar_Imagem_TMP();
			
			return $response;
		});
		
		$app->post('', function (Request $request, Response $response) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			if (application\controller\usuario\meu_perfil\meus_dados\Concluir::Concluir_Cadastro()) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response->withRedirect('/usuario/meu-perfil/meus-dados/concluir/');
			}
		});
	});
	
	$app->run();
?>