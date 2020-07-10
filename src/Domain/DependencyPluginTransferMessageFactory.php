<?php


namespace Domain;



class DependencyPluginTransferMessageFactory
{

    public static function create(array $data):DependencyPluginTransferMessage{
        return new DependencyPluginTransferMessage($data);
    }
}
