<?php


namespace Domain\City;

interface CityDAOInterface
{
    public function get(int $databaseID): array;

    public function update(City $City): bool;

    public function delete(int $databaseID): bool;

    public function create(City $city): bool;
}
