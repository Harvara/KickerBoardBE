<?php

//define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
//require ROOT_PATH . "vendor/autoload.php";


class Player
{
    private $playerName;
    private $firstName;
    private $lastName;
    private $city;
    private $dbID;


    public function __construct()
    {
    }

    public  static  function fromUserInput($userInput){
        $instance = new self();
        $members = $instance->createMembersFromUserInput($userInput);
        $instance->fill($members);
        return $instance;
    }

    public static function withDBContent($dbContent){
        $instance = new self();
        $members = $instance->createMembersFromDBContent($dbContent);
        $instance->fill($members);
        return $instance;
    }

    public  static function  defaultPlayer(){
        $instance = new self();
        $members = $instance->createMembersDefault();
        $instance->fill($members);
        return $instance;
    }

    public  function createMembersDefault(){
        $members = [];
        $members["playerName"]="";
        $members["fistName"]="";
        $members["lastName"]="";
        $members["city"]=null;
        $members["dbID"]=0;
        return $members;
    }

    private function createMembersFromUserInput($userInput){
        $members = [];
        $members["playerName"]=$userInput["playername"];
        $members["playerName"]=$userInput["firstname"];
        $members["playerName"]=$userInput["lastname"];
        $members["City"]=City::getCityFromCityName($userInput["city"]);
        return $members;
    }

    private function createMembersFromDBContent($dbContent){
        $members=[];
        $members["playerName"]=$dbContent["Playername"];
        $members["firstName"]=$dbContent["Firstname"];
        $members["lastName"]=$dbContent["Lastname"];
        $members["city"]=City::createCityFromID($dbContent["CityID"]);
        $members["dbID"]=$dbContent["ID"];
        return $members;
    }

    private function fill($members){
        $this->playerName=$members["playerName"];
        $this->firstName=$members["firstName"];
        $this->lastName=$members["lastName"];
        $this->city=$members["city"];
        $this->dbID=$members["dbID"];
    }

    private function getPlayerDataFromDB($dbID){
        $pdo = new DatabaseConnection();
        $pdo = $pdo->create();
        $sql = "select * from Players where ID=:id";
        $statement = $pdo->prepare($sql);
        $statement->bindValues("id",$dbID);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPlayerDataAsJson(){
        $city = $this->city->getCityAsJson();
        $city = json_decode($city);
        $player = json_encode(get_object_vars($this));
        $player = json_decode($player,true);
        $player["city"] = $city;
        $player = json_encode($player);
        echo $player .PHP_EOL;
        return json_encode(get_object_vars($this));
    }

    public function getPlayerName()
    {
        return $this->playerName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getCity()
    {
        return $this->city;
    }



}