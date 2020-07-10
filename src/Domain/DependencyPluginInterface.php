<?php


namespace Domain;


interface DependencyPluginInterface
{
    public function execute();
    public function setDependencyPluginTransferMessage(
        DependencyPluginTransferMessage $dependencyPluginTransferMessage
    ): void;
    public function getDependencyPluginTransferMessage(): DependencyPluginTransferMessage;
}
