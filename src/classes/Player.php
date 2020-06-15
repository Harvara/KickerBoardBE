<?php


class Player
{
    public $playerName;
    public $firstName;
    public $lastName;
    public $city;
    public $dbID;


    public function __construct()
    {
    }

    public static function  withPlayername($playername){
        $instance = new self();
        $dbContent = $instance->getPlayerDataFromDB($playername,"Playername");
        if(sizeof($dbContent)==0){
            return null;
        }
        $instance->fill($dbContent);
        return $instance;
    }

    public static function  withPlayerID($playerid){
        $instance = new self();
        $dbContent = $instance->getPlayerDataFromDB($playerid,"ID");
        if(sizeof($dbContent)==0){
            return null;
        }
        $instance->fill($dbContent);
        return $instance;
    }

    public static function validateName($name){
        $regex = "/^[A-ZÖÄÜ][a-zöäüß]*$/";
        $regexOk = preg_match($regex, $name);
        if ($regexOk && strlen($name)>0){
            return true;
        }
        return false;
    }

    public static function validatePlayerName($name){
        $regex = "/^[A-ZÖÄÜa-zöäüß0-9]*$/";
        $regexOk = preg_match($regex, $name);
        if ($regexOk && strlen($name)>0){
            return true;
        }
        return false;
    }

    public static function checkIfPlayerExists($value, $attribute){
        $playerData = self::getPlayerDataFromDB($value, $attribute);
        if (!$playerData){
            return false;
        }
        else{
            return  true;
        }
    }

    private function fill($members){
        $this->playerName=$members["Playername"];
        $this->firstName=$members["Firstname"];
        $this->lastName=$members["Lastname"];
        $city = City::withID($members["CityID"]);
        $this->city=$city;
        $this->dbID=$members["ID"];
    }

    private function getPlayerDataFromDB($value, $attribute){
        $pdo = new DatabaseConnection();
        $pdo = $pdo->create();
        $statement = self::createPDOStatement($value, $attribute, $pdo);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result)===1) $result=$result[0];
        return $result;
    }

    private function createPDOStatement($value, $attribute, $pdo){
        $statement = null;
        switch ($attribute){
            case "Playername":
                $sql = "select * from Players where Playername = :playername";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(":playername", $value);
                break;
            case "ID":
                $sql = "select * from Players where ID = :id";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(":id", $value);
                break;
            default:
                die("Error");
        }
        return $statement;
    }

    public function getPlayerDataAsJson(){
        $city = $this->city->getCityDataAsJson();
        $city = json_decode($city);
        $player = json_encode(get_object_vars($this));
        $player = json_decode($player,true);
        $player["city"] = $city;
        $player = json_encode($player);
        return $player;
    }




}