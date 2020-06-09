<?php

//define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
//require ROOT_PATH . "vendor/autoload.php";


class Player
{
    public $playerName;
    public $firstName;
    public $lastName;
    public $city;
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

    public static function createFromName(){
        $instance = new self();
    }


    public static function validateName($name){
        $regex = "/^[A-ZÖÄÜ][a-zöäüß]*$/";
        return preg_match($regex, $name);
    }

    public static function validatePlayerName($name){
        $playerData = self::getPlayerDataFromDB($name, "playername");
        if (!$playerData){
            $regex = "/^[A-ZÖÄÜ][a-zöäüß]*$/";
            return preg_match($regex, $name);
        }
        return false;
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
        $members["city"]=City::withID($dbContent["CityID"]);
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

    private function getPlayerDataFromDB($value, $attribute){
        $pdo = new DatabaseConnection();
        $pdo = $pdo->create();
        $statement = null;
        switch ($attribute){
            case "playername":
                $sql = "select * from Players where Playername = :playername";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(":playername", $value);
                break;
            case "id":
                $sql = "select * from Players where ID = :id";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(":id", $value);
                break;
            default:
                $sql = "select * from Players";
                $statement = $pdo->prepare($sql);
                break;
        }
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result)===1) $result=$result[0];
        return $result;
    }

    public function getPlayerDataAsJson(){
        $city = $this->city->getCityAsJson();
        $city = json_decode($city);
        $player = json_encode(get_object_vars($this));
        $player = json_decode($player,true);
        $player["city"] = $city;
        $player = json_encode($player);
        return $player;
    }




}