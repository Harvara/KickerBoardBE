<?php


namespace Domain\Player;


use Domain\Player\Player;

interface PlayerFactoryInterface
{
    public static function create(string $playerName):Player;
    public static function createWithDatabaseID(int $databaseID):Player;
}
