<?php


use Domain\Player\PlayerController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Domain\Request\RequestDTO;

require_once "vendor/autoload.php";

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});


$app->get('/api/player/{mode}', function (Request $request, Response $response, $args) {
    $mode = $args["mode"];
    $requestData = new RequestDTO($response, $request);
    $response = (new PlayerController())->indexAction($mode, $requestData);
    return $response->withHeader("Content-type", "application/json");
});

function getSingle(){
    echo "Call from index.php";
}

$app->run();



