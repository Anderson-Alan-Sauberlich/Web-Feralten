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
	
	$app->get('/menu_pesquisa/marca/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/include_page/menu.php');
		
		//application\controller\include_page\Menu::
		
		return $response;
	});
	
	$app->get('/menu_pesquisa/modelo/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/include_page/menu.php');
	
		//application\controller\include_page\Menu::
	
		return $response;
	});
	
	$app->get('/usuario/meu-perfil/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/view/html/usuario/meu_perfil/perfil.php');
		
		return $response;
	});

	$app->get('/usuario/meu-perfil/auto-pecas/cadastrar/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/view/html/usuario/meu_perfil/auto_pecas/cadastrar.php');
		
		return $response;
	});
	
	$app->get('/usuario/meu-perfil/auto-pecas/visualizar/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/view/html/usuario/meu_perfil/auto_pecas/visualizar.php');
		
		return $response;
	});

	$app->get('/cabecalho/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/view/src/include_page/cabecalho.php');
		
		return $response;
	});
	
	$app->get('/teste/', function (Request $request, Response $response) use ($app) {
		
		return $response->withRedirect('/');
	});
	
	$app->post('/usuario/login/', function (Request $request, Response $response) use ($app) {
		require_once(RAIZ.'/application/controller/usuario/login.php');
	
		//application\controller\usuario\Cadastro::
	
		return $response;
	});
	
	$app->run();
?>
