<?php


namespace Kickerboard\Domain\Player;


use Domain\Player\Player;

class PlayerFactory implements PlayerFactoryInterface
{


    public function createWithDatabaseID(int $databaseID): Player
    {

    }

    public function create(string $playerName): Player
    {
        // TODO: Implement create() method.
    }
}
