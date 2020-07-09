<?php


namespace Domain;


use Domain\Request\RequestDTO;
use Psr\Http\Message\ResponseInterface as Response;

interface ControllerInterface
{
    public function indexAction(string $mode, RequestDTO $requestDTO): Response;

    public function getSingle(array $args, RequestDTO $requestDTO): Response;

    public function getAll(array $args, RequestDTO $requestDTO): Response;
}
