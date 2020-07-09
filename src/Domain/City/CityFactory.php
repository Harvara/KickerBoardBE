<?php


namespace Domain\City;


class CityFactory
{
    public static function create(string $cityName): City
    {

    }

    public static function createWithDatabaseID(int $id): City
    {
        $data = (new CityDAO())->get($id);
        return self::createCityFromArray($data);
    }

    private static function createCityFromArray(array $data)
    {
        $city = new City();
        $city->setName($data["Name"]);
        $city->setDatabaseID($data["ID"]);
        return $city;
    }
}
