<?php

class City
{
    private $cityName;
    private $dbID;

    public function __construct($cityName, $dbID)
    {
        $this->cityName = $cityName;
        $this->dbID = $dbID;
    }


    public function getCityFromID(){
        $instance = new self("Jena", "1");
    }

    public  function getCityFromCityName($name){

    }


    public function getCityName()
    {
        return $this->cityName;
    }


}