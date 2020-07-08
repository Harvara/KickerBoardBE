<?php


namespace Domain\Player;


use Domain\Request\RequestDTO;
use phpDocumentor\Reflection\Types\This;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PlayerController implements \Domain\ControllerInterface
{

    const MODES = array(
        "getPlayer" => "getSingle1",
        "getAll" => "getAll"
    );

    public function indexAction(string $mode, RequestDTO $requestDTO): Response
    {
        if($this->isValid($mode)){
            return $this->switchModes($mode, $requestDTO);
        }
        return $this->unknownEndpointResponse($requestDTO);

    }

    public function getSingle(array $args, RequestDTO $requestDTO): Response
    {
        echo "hi";
        return $requestDTO->getResponse();
        /*
        $response = $requestDTO->getResponse();
        $response->getBody()->write("Hello");
        return $response;*/
    }

    public function getAll(array $args, RequestDTO $requestDTO): Response
    {
        // TODO: Implement getAll() method.
    }

    private function isValid($mode){
        return array_key_exists($mode, self::MODES);
    }

    private function switchModes($mode, RequestDTO $requestDTO):Response{
        $args = $requestDTO->getRequest()->getQueryParams();
        $response = call_user_func(self::MODES[$mode], array($args, $requestDTO));
        $response = $requestDTO->getResponse();
        $response->getBody()->write("Hello");
        return $response;
    }

    private function unknownEndpointResponse(RequestDTO $requestDTO):Response{
        $response = $requestDTO->getResponse();
        $response->getBody()->write("Unkown Endpoint");
        return $response;
    }

}
