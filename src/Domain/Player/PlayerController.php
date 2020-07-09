<?php


namespace Domain\Player;


use Domain\Request\RequestDTO;
use Psr\Http\Message\ResponseInterface as Response;

class PlayerController implements \Domain\ControllerInterface
{

    const MODES = array(
        "getPlayer" => "getSingle",
        "getAll" => "getAll"
    );

    public function indexAction(string $mode, RequestDTO $requestDTO): Response
    {
        if($this->isValidMode($mode)){
            return $this->switchModes($mode, $requestDTO);
        }
        return $this->unknownEndpointResponse($requestDTO);

    }

    public function getSingle(array $args, RequestDTO $requestDTO): Response
    {
        $player = (new PlayerFacade())->getSinglePlayer($args["id"]);
        $response = $requestDTO->getResponse();
        $response->getBody()->write($player->getObjectAsJson());
        return $response;
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

    private function isValidMode($mode){
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
        $responseString = json_encode(array(
            "Message" => "Unknown Endpoint"
        ));
        $response->getBody()->write($responseString);
        return $response;
    }

}
