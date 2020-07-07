<?php


namespace Domain\Player;


use Domain\City\CityFactory;


class PlayerFactory implements PlayerFactoryInterface
{


    public static function createWithDatabaseID(int $databaseID): Player
    {
        $data = (new PlayerDAO())->get($databaseID);
        return self::createPlayerFromArray($data);
    }

    public static function create(string $playerName): Player
    {
        $player = new Player();
        $player->setPlayername($playerName);
        return $player;
    }

    private static function createPlayerFromArray(array $data){
        $player = new Player();
        $player->setPlayername($data["Playername"]);
        $player->setLastname($data["Lastname"]);
        $player->setFirstname($data["Firstname"]);
        $city = CityFactory::createWithDatabaseID($data["CityID"]);
        $player->setCity($city);
        return $player;
    }
}
