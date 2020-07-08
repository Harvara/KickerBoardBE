<?php


namespace Domain\Player;


class PlayerFacade implements PlayerFacadeInterface
{

    public function getSinglePlayer(int $playerID): Player
    {
        return  PlayerFactory::createWithDatabaseID($playerID);
    }

    public function getAllPlayers(): array
    {
        $idArray = (new PlayerDAO())->getAllIDs();
        $playerArray = [];
        foreach ($idArray as $playerID){
            array_push($playerArray,PlayerFactory::createWithDatabaseID($playerID));
        }
        return $playerArray;
    }

    public function deletePlayer(int $playerID): bool
    {
        // TODO: Implement deletePlayer() method.
    }

    public function createPlayer(Player $player): bool
    {
        // TODO: Implement createPlayer() method.
    }

    public function updatePlayer(Player $player): bool
    {
        // TODO: Implement updatePlayer() method.
    }
}
