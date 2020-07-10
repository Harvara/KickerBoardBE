<?php


namespace Domain\Match;


use Domain\DependencyPluginInterface;
use Domain\DependencyPluginTransferMessage;
use Domain\DependencyProviderInterface;
use Domain\Match\Plugins\MatchIDPrecheckPlugin;


class MatchDependencyProvider implements DependencyProviderInterface
{

    /**
     * @var DependencyPluginInterface[]
     */
    private $dependencyPlugins;

    /**
     * @var DependencyPluginTransferMessage
     */
    private $dependencyPluginTransferMessage;

    public function __construct(DependencyPluginTransferMessage $dependencyPluginTransferMessage)
    {
        $this->dependencyPlugins=[
            new MatchIDPrecheckPlugin()
        ];
        $this->dependencyPluginTransferMessage = $dependencyPluginTransferMessage;
    }


    /**
     * @return DependencyPluginTransferMessage[]
     */
    public function check(): void
    {
        foreach ($this->dependencyPlugins as $dependencyPlugin){
            $dependencyPlugin->setDependencyPluginTransferMessage($this->dependencyPluginTransferMessage);
            $dependencyPlugin->execute();
            $this->dependencyPluginTransferMessage = $dependencyPlugin->getDependencyPluginTransferMessage();
        }
    }

    /**
     * @return DependencyPluginTransferMessage
     */
    public function getDependencyPluginTransferMessage(): DependencyPluginTransferMessage
    {
        return $this->dependencyPluginTransferMessage;
    }


}
