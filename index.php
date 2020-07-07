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
    $response->getBody()->write("Hello Player!");
    return $response;
});

$app->run();




/*
use Domain\Player\Player;

require_once "vendor/autoload.php";


echo "hello";


$player = new Player();

$player->createPlayer();

*/
