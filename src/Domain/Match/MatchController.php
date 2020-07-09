<?php


namespace Domain\Match;


use Domain\Request\RequestDTO;
use Psr\Http\Message\ResponseInterface as Response;

class MatchController implements MatchControllerInterface
{
    const MODES = array(
        "getMatch" => "getSingle",
        "getAll" => "getAll"
    );

    public function indexAction(string $mode, RequestDTO $requestDTO):Response{
        if($this->isValidMode($mode)){
            return $this->switchModes($mode, $requestDTO);
        }
        return $this->unknownEndpointResponse();
    }


    private function switchModes(string $mode, RequestDTO $requestDTO):Response{
        $args = $requestDTO->getRequest()->getQueryParams();
        switch ($mode){
            case "getMatch":
                return $this->getSingle($args, $requestDTO);
            case "getAll":
                return $this->getAll($args, $requestDTO);
        }
    }

    public function getSingle(array $args, RequestDTO $requestDTO):Response{
        $match = (new MatchFacade())->getSingleMatch($args["id"]);
        $response = $requestDTO->getResponse();
        $response->getBody()->write($match->getObjectAsJson());
        return $response;
    }

    public function getAll(array $args, RequestDTO $requestDTO):Response{

    }

    private function isValidMode($mode){
        return array_key_exists($mode, self::MODES);
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
