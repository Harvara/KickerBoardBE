<?php



use Domain\Player\PlayerFactory;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once "vendor/autoload.php";

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});


$app->get('/Player', function (Request $request, Response $response, $args) {
    $player = PlayerFactory::createWithDatabaseID(1);
    echo $player->getObjectAsJson();
    $response->getBody()->write("Hello Player!");
    return $response;
});

$app->run();



