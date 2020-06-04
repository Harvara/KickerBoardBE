<?php


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";

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

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->cityName;
    }


}