<?php


namespace Kickerboard\Domain\Player;


use Domain\Player\Player;

interface PlayerFactoryInterface
{
    public function create(string $playerName):Player;
    public function createWithDatabaseID(int $databaseID):Player;
}
