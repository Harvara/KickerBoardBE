<?php
namespace Domain;

interface CityInterface
{
    public function createCity(\DTO\City\City $city): CityReponse;
    public function removeCity(\DTO\City\City $city): CityReponse;
    public function updateCity(\DTO\City\City $city): CityReponse;
}
