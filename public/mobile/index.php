<?php
    require_once('../../config.php');
    require_once('../../vendor/autoload.php');
    
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    
    $app = new \Slim\App();
    
    $app->group('/', function() use ($app) {
        
    });
    
    $app->run();
