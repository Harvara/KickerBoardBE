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


    public function __construct($dbContent = false, $userInput = false)
    {
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

    public  function  createDefaultPlayer(){
        $instance = new self();
        $instance->playerName="Henry";
        return $instance;
    }

    private function createMembersFromUserInput($userInput){
        $members = [];
        $members["playerName"]=$userInput["playername"];
        $members["playerName"]=$userInput["firstname"];
        $members["playerName"]=$userInput["lastname"];
        $members["City"]=City::getCityFromCityName();
    }

    private function createMembersFromDBContent($dbContent){
        $members=[];
        $members["playerName"]=$dbContent["Playername"];
        $members["playerName"]=$dbContent["Firstname"];
        $members["playerName"]=$dbContent["Lastname"];
        $members["City"]=City::getCityFromID();
        $members["dbID"]=$dbContent["ID"];

    }

    public function fillPlayerFromDBID($dbID){
        $data = $this->getPlayerDataFromDB($dbID);
        $this->createMembersFromDBContent($data);
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