<?php


namespace Kickerboard\Domain\Player;


use Domain\Player\Player;
use Kickerboard\Domain\City\CityFactory;

class PlayerFactory implements PlayerFactoryInterface
{


    public static function createWithDatabaseID(int $databaseID): Player
    {
        $data = (new PlayerDAO())->get($databaseID);
        return self::createPlayerFromArray($data);
    }

    public static function create(string $playerName): Player
    {
        // TODO: Implement create() method.
    }

    private function createPlayerFromArray(array $data){
        $player = new Player($data["Playername"]);
        $player->setLastname($data["Lastname"]);
        $player->setFirstname($data["Firstname"]);
        $city = CityFactory::createWithDatabaseID($data["CityID"]);
        $player->setCity($city);
        return $player;
    }
}
