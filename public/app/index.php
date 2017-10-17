<?php
	require_once('../../config.php');
	require_once('../../vendor/autoload.php');
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	$app = new \Slim\App();
	
	$app->group('/cmmv', function() use ($app) {
	    $app->get('/categoria/{categoria}[/]', function(Request $request, Response $response, $args) use ($app) {
	        $cmmv = new module\app\controller\CMMV();
	        
	        if (isset($args['categoria'])) {
	            $cmmv->set_categoria($args['categoria']);
	        }
	        
	        $cmmv->Retornar_Categoria();
	        
	        return $response;
	    });
	    
	    $app->get('/marca/{marca}[/]', function(Request $request, Response $response, $args) use ($app) {
	        $cmmv = new module\app\controller\CMMV();
	        
	        if (isset($args['marca'])) {
	            $cmmv->set_marca($args['marca']);
	        }
	        
	        $cmmv->Retornar_Marca();
	        
	        return $response;
	    });
	    
	    $app->get('/modelo/{modelo}[/]', function(Request $request, Response $response, $args) use ($app) {
	        $cmmv = new module\app\controller\CMMV();
	        
	        if (isset($args['modelo'])) {
	            $cmmv->set_modelo($args['modelo']);
	        }
	        
	        $cmmv->Retornar_Modelo();
	        
	        return $response;
	    });
	    
	    $app->get('/versao/{versao}[/]', function(Request $request, Response $response, $args) use ($app) {
	        $cmmv = new module\app\controller\CMMV();
	        
	        if (isset($args['versao'])) {
	            $cmmv->set_versao($args['versao']);
	        }
	        
	        $cmmv->Retornar_Versao();
	        
	        return $response;
	    });
	    
	    $app->get('/categorias[/]', function(Request $request, Response $response, $args) use ($app) {
	        $cmmv = new module\app\controller\CMMV();
	        
	        $cmmv->Retornar_Categorias();
	        
	        return $response;
	    });
	    
	    $app->get('/marcas/{categoria}[/]', function(Request $request, Response $response, $args) use ($app) {
	        $cmmv = new module\app\controller\CMMV();
	        
	        if (isset($args['categoria'])) {
	            $cmmv->set_categoria($args['categoria']);
	        }
	        
	        $cmmv->Retornar_Marcas_Por_Categoria();
	        
	        return $response;
	    });
	    
	    $app->get('/modelos/{marca}[/]', function(Request $request, Response $response, $args) use ($app) {
	        $cmmv = new module\app\controller\CMMV();
	        
	        if (isset($args['marca'])) {
	            $cmmv->set_marca($args['marca']);
	        }
	        
	        $cmmv->Retornar_Modelos_Por_Marca();
	        
	        return $response;
	    });
	    
		$app->get('/versoes/{modelo}[/]', function(Request $request, Response $response, $args) use ($app) {
		    $cmmv = new module\app\controller\CMMV();
		    
		    if (isset($args['modelo'])) {
		        $cmmv->set_modelo($args['modelo']);
		    }
		    
		    $cmmv->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
	});
	
	$app->run();
?>