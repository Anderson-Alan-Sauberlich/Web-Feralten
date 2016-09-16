<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	require_once('config.php');
	require_once('vendor/autoload.php');
	
	$config['displayErrorDetails'] = true;
	
	$app = new \Slim\App(["settings" => $config]);
	
	$app->get('/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/pagina_inicial.php');
		
		application\controller\Pagina_Inicial::Carregar_Pagina();
		
		return $response;
	});
	
	$app->get('/usuario/login/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/login.php');
		
		application\controller\usuario\Login::Carregar_Pagina();
		
		return $response;
	});
	
	$app->get('/usuario/cadastro/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/cadastro.php');
		
		application\controller\usuario\Cadastro::Carregar_Pagina();
		
		return $response;
	});
	
	$app->post('/usuario/cadastro/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/cadastro.php');
	
		if (application\controller\usuario\Cadastro::Cadastrar_Usuario()) {
			return $response->withRedirect('/usuario/meu-perfil/');
		} else {
			return $response->withRedirect('/usuario/cadastro/');
		}
	});
	
	$app->get('/menu_pesquisa/marca/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/include_page/menu.php');
		
		application\controller\include_page\Menu::Retornar_Marcas_Por_Categoria();
		
		return $response;
	});
	
	$app->get('/menu_pesquisa/modelo/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/include_page/menu.php');
	
		application\controller\include_page\Menu::Retornar_Modelos_Por_Marca();
	
		return $response;
	});
	
	$app->get('/usuario/meu-perfil/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/meu_perfil/perfil.php');
		
		application\controller\usuario\meu_perfil\Perfil::Carregar_Pagina();
		
		return $response;
	});

	$app->get('/usuario/meu-perfil/auto-pecas/cadastrar/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/cadastrar.php');
		
		application\controller\usuario\meu_perfil\auto_pecas\Cadastrar::Carregar_Pagina();
		
		return $response;
	});
	
	$app->get('/usuario/meu-perfil/auto-pecas/visualizar/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/visualizar.php');
		
		application\controller\usuario\meu_perfil\auto_pecas\Visualizar::Carregar_Pagina();
		
		return $response;
	});
	
	$app->get('/usuario/meu-perfil/auto-pecas/atualizar/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/atualizar.php');
	
		application\controller\usuario\meu_perfil\auto_pecas\Atualizar::Carregar_Pagina();
	
		return $response;
	});
	
	$app->get('/usuario/meu-perfil/meus-dados/atualizar/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
	
		application\controller\usuario\meu_perfil\meus_dados\Atualizar::Carregar_Pagina();
	
		return $response;
	});
	
	$app->post('/usuario/meu-perfil/meus-dados/atualizar/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
	
		application\controller\usuario\meu_perfil\meus_dados\Atualizar::Post_Request();
	
		return $response->withRedirect('/usuario/meu-perfil/meus-dados/atualizar/');
	});
	
	$app->post('/usuario/login/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/login.php');
		
		if (application\controller\usuario\Login::Autenticar_Usuario_Login($_POST["email"], $_POST["password"], $_POST['manter_login'])) {
			return $response->withRedirect('/usuario/meu-perfil/');
		} else {
			return $response->withRedirect('/usuario/login/');
		}
	});
	
	$app->run();
?>
