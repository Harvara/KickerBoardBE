<?php


namespace Domain\Player;


use Domain\City\CityFactory;
use Domain\DefaultObjectInterface;


class PlayerFactory implements PlayerFactoryInterface
{


    public static function createWithDatabaseID(int $databaseID): DefaultObjectInterface
    {
        $data = (new PlayerDAO())->get($databaseID);
        return self::createPlayerFromArray($data);
    }

    public static function create(string $playerName): DefaultObjectInterface
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
        $player->setDatabaseID($data["ID"]);
        $city = CityFactory::createWithDatabaseID($data["CityID"]);
        $player->setCity($city);
        return $player;
    }
}
