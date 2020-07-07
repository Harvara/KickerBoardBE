<?php


namespace Domain\Player;


interface PlayerFactoryInterface
{
    public static function create(string $playerName):Player;
    public static function createWithDatabaseID(int $databaseID):Player;
}
