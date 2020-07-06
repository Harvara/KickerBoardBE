<?php


namespace Kickerboard\Domain\City;


use Domain\City\City;

interface CityDAOInterface
{
    public function get($databaseID) : array ;
    public function update(City $City):bool ;
    public function delete($databaseID):bool ;
    public function create(City $city):bool ;
}
