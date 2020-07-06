<?php


namespace Kickerboard\Domain\City;


use Domain\City\City;

class CityFactory
{
    public static function create(string $cityName):City{

    }

    public static function createWithDatabaseID(int $id): City{
        $data = (new CityDAO())->get($id);
        return self::createCityFromArray($data);
    }

    private function createCityFromArray(array $data){
        $city = new City($data["Name"]);
        $city->setDatabaseID($data["ID"]);
        return $city;
    }
}
