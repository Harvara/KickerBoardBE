<?php


namespace Domain;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Domain\Request\RequestDTO;

interface ControllerInterface
{
    public function indexAction(string  $mode, RequestDTO $requestDTO): Response;
    public function getSingle(array $args,RequestDTO $requestDTO): Response;
    public function getAll(array $args, RequestDTO $requestDTO): Response;
}
