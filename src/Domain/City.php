<?php

namespace Domain;

class City implements CityInterface
{
    public function createCity(\DTO\City\City $city): CityReponse
    {
        // ... create city with xyz
    }

    public function removeCity(\DTO\City\City $city): CityReponse
    {
        // TODO: Implement removeCity() method.
    }

    public function updateCity(\DTO\City\City $city): CityReponse
    {
        // TODO: Implement updateCity() method.
    }
}
