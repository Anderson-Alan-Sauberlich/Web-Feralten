<?php
    require_once('../../config.php');
    require_once('../../vendor/autoload.php');
    
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    
    $app = new \Slim\App();
    
    $app->group('/cmmv', function() use ($app) {
        $app->get('/categorias[/{data}[/]]', function(Request $request, Response $response, $args) use ($app) {
            $cmmv = new Module\App\Controller\CMMV();
            
            $cmmv->Retornar_Categorias();
            
            return $response;
        });
        
        $app->get('/marcas[/{data}[/]]', function(Request $request, Response $response, $args) use ($app) {
            $cmmv = new Module\App\Controller\CMMV();
            
            $cmmv->Retornar_Marcas();
            
            return $response;
        });
        
        $app->get('/modelos[/{data}[/]]', function(Request $request, Response $response, $args) use ($app) {
            $cmmv = new Module\App\Controller\CMMV();
            
            $cmmv->Retornar_Modelos();
            
            return $response;
        });
        
        $app->get('/versoes[/{data}[/]]', function(Request $request, Response $response, $args) use ($app) {
            $cmmv = new Module\App\Controller\CMMV();
            
            $cmmv->Retornar_Versoes();
            
            return $response;
        });
    });
    
    $app->group('/compatibilidade', function() use ($app) {
        $app->get('/categorias[/{data}[/]]', function(Request $request, Response $response, $args) use ($app) {
            $cmmv = new Module\App\Controller\Compatibilidade();
            
            $cmmv->Retornar_Categorias();
            
            return $response;
        });
        
        $app->get('/marcas[/{data}[/]]', function(Request $request, Response $response, $args) use ($app) {
            $cmmv = new Module\App\Controller\Compatibilidade();
            
            $cmmv->Retornar_Marcas();
            
            return $response;
        });
        
        $app->get('/modelos[/{data}[/]]', function(Request $request, Response $response, $args) use ($app) {
            $cmmv = new Module\App\Controller\Compatibilidade();
            
            $cmmv->Retornar_Modelos();
            
            return $response;
        });
        
        $app->get('/versoes[/{data}[/]]', function(Request $request, Response $response, $args) use ($app) {
            $cmmv = new Module\App\Controller\Compatibilidade();
            
            $cmmv->Retornar_Versoes();
            
            return $response;
        });
    });
    
    $app->run();
