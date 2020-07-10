<?php


namespace Domain\Match\Plugins;


use Domain\DependencyPluginInterface;
use Domain\DependencyPluginTransferMessage;
use Domain\Match\MatchFacade;

class MatchIDPrecheckPlugin implements DependencyPluginInterface
{
    /**
     * @var DependencyPluginTransferMessage
     */
    private $dependencyPluginTransferMessage;



    public function execute(): DependencyPluginTransferMessage
    {
        $matchData = $this->dependencyPluginTransferMessage->getData("matchData");
        $match = (new MatchFacade)->getSingleMatch($matchData["matchID"]);
        if (!$match->isPlayDateSet()){
            $this->dependencyPluginTransferMessage->setRunWithoutError(false);
            $this->dependencyPluginTransferMessage->addErrorMessage("No Match found");
        }
        return $this->dependencyPluginTransferMessage;
    }

    /**
     * @return DependencyPluginTransferMessage
     */
    public function getDependencyPluginTransferMessage(): DependencyPluginTransferMessage
    {
        return $this->dependencyPluginTransferMessage;
    }

    /**
     * @param DependencyPluginTransferMessage $dependencyPluginTransferMessage
     */
    public function setDependencyPluginTransferMessage(DependencyPluginTransferMessage $dependencyPluginTransferMessage): void
    {
        $this->dependencyPluginTransferMessage = $dependencyPluginTransferMessage;
    }







}
