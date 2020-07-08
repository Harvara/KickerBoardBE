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
        $player = PlayerFactory::createWithDatabaseID($args["id"]);
        $respone = $requestDTO->getResponse();
        $respone->getBody()->write($player->getObjectAsJson());
        return $respone;
    }

    public function getAll(array $args, RequestDTO $requestDTO): Response
    {
        $playerArray = (new PlayerFacade())->getAllPlayers();
        $playersAsJson = [];
        foreach ($playerArray as $player){
            /**
             * @var Player $player
             */
            array_push($playersAsJson, json_decode($player->getObjectAsJson()));
        }
        $response = $requestDTO->getResponse();
        $response->getBody()->write(json_encode($playersAsJson));
        return  $response;
    }

    private function isValid($mode){
        return array_key_exists($mode, self::MODES);
    }

    private function switchModes($mode, RequestDTO $requestDTO):Response{
        $args = $requestDTO->getRequest()->getQueryParams();

        switch ($mode){
            case "getPlayer":
                return $this->getSingle($args, $requestDTO);
            case "getAll":
                return $this->getAll($args, $requestDTO);
            default:
                return $requestDTO->getResponse();
        }

        /*
        $response = call_user_func("getSingle", array($args, $requestDTO));
        return $requestDTO->getResponse();
        */
    }

    private function unknownEndpointResponse(RequestDTO $requestDTO):Response{
        $response = $requestDTO->getResponse();
        $response->getBody()->write("Unkown Endpoint");
        return $response;
    }

}
