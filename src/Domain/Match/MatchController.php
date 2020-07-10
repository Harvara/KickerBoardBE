<?php


namespace Domain\Match;


use Domain\DependencyPluginTransferMessage;
use Domain\DependencyPluginTransferMessageFactory;
use Domain\Request\RequestDTO;
use Psr\Http\Message\ResponseInterface as Response;

class MatchController implements MatchControllerInterface
{
    const MODES = array(
        "getMatch" => "getSingle",
        "getAll" => "getAll"
    );

    public function indexAction(string $mode, RequestDTO $requestDTO): Response
    {
        if ($this->isValidMode($mode)) {
            return $this->switchModes($mode, $requestDTO);
        }
        return $this->unknownEndpointResponse();
    }


    private function switchModes(string $mode, RequestDTO $requestDTO): Response
    {
        $args = $requestDTO->getRequest()->getQueryParams();
        switch ($mode) {
            case "getMatch":
                return $this->getSingle($args, $requestDTO);
            case "getAll":
                return $this->getAll($args, $requestDTO);
        }
    }

    public function getSingle(array $args, RequestDTO $requestDTO): Response
    {
        if ($this->runDependencyProvider($args)){
            $match = (new MatchFacade())->getSingleMatch($args["id"]);
            $response = $requestDTO->getResponse();
            $response->getBody()->write($match->getObjectAsJson());
            return $response;
        }
        return $this->unknownEndpointResponse($requestDTO);


    }

    public function getAll(array $args, RequestDTO $requestDTO): Response
    {

    }

    private function isValidMode($mode)
    {
        return array_key_exists($mode, self::MODES);
    }


    private function unknownEndpointResponse(RequestDTO $requestDTO): Response
    {
        $response = $requestDTO->getResponse();
        $responseString = json_encode(array(
            "Message" => "Unknown Endpoint"
        ));
        $response->getBody()->write($responseString);
        return $response;
    }

    /**
     * @param array $args
     * @param DependencyPluginTransferMessage[] $dependencyPluginTransferMessage
     * @return bool
     */
    private function runDependencyProvider(array $args):bool{
        $dependencyProvider = new MatchDependencyProvider($this->prepareDependencyPluginTransferMessage($args));
        $dependencyProvider->check();
        return $dependencyProvider->getDependencyPluginTransferMessage()->isRunWithoutError ();
    }

    /**
     * @param array $args
     * @return DependencyPluginTransferMessage
     */
    private function prepareDependencyPluginTransferMessage(array $args):DependencyPluginTransferMessage{
        $matchData = array(
            "matchData" => array(
                "matchID" => $args["id"]
            )
        );
        $dependencyPluginTransferMessage =
            DependencyPluginTransferMessageFactory::create($matchData);
        $dependencyPluginTransferMessage->setRunWithoutError(true);
        return  $dependencyPluginTransferMessage;
    }
}
