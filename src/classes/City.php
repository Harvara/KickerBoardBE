<?php

class City
{
    private $cityName;
    private $dbID;

    public function __construct()
    {
    }


    public  static  function withDBContent($dbContent){
        $instance = new self();
        $members = $instance->createMembersFromDBContent($dbContent);
        $instance->fill($members);
        return $instance;
    }

    public static function withID($dbid){
        $instance = new self();
        $dbContent = $instance->getCityFromDB($dbid, "ID");
        if (sizeof($dbContent) != 1){
            return null;
        }
        $members = $instance->createMembersFromDBContent($dbContent[0]);
        $instance->fill($members);
        return $instance;
    }

    public static  function createNewWithName($name){
        $instance = new self();
        $instance->createNewDBEntryByName($name);
        return City::withDBName($name);
    }


    public  static function withDBName($cityName){
        $instance = new self();
        $dbContent = $instance->getCityFromDB($cityName, "Name");
        if (sizeof($dbContent) != 1){
            return false;
        }
        $members = $instance->createMembersFromDBContent($dbContent[0]);
        $instance->fill($members);
        return $instance;
    }

    private  function createNewDBEntryByName($name){
        $pdo = new DatabaseConnection();
        $pdo = $pdo->create();
        $sql = "Insert into Cities (Name) values (:name)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":name", $name);
        return $statement->execute();
    }


    public static function validateName($name){
            $regex = "/^[A-ZÖÄÜ][a-zöäüß]*$/";
            return preg_match($regex, $name);
    }

    private function getCityFromDB($value,$attribute){
        $pdo = new DatabaseConnection();
        $pdo = $pdo ->create();
        $sql ="";
        $statement = null;
        if (!$value || !$attribute){
            $sql = "Select * from Cities";
            $statement = $pdo->prepare($sql);
            $statement->execute();
        }else{
            switch ($attribute){
                case "ID":
                    $sql="Select * from Cities where ID=:value";
                    break;
                case "Name":
                    $sql = "Select * from Cities where Name=:value";
            }
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":value", $value);
            $statement->execute();
        }
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }




    private function createMembersFromDBContent($dbContent){
        $members = [];
        $test = [
            "test" => "abv",
            "qwe" => "fjf"
        ];
        $members["dbID"]=$dbContent["ID"];
        $members["cityName"]=$dbContent["Name"];
        return $members;
    }

    public function getCityDataAsJson(){
        return json_encode(get_object_vars($this));
}


    private function fill($members){
        $this->dbID=$members["dbID"];
        $this->cityName=$members["cityName"];
    }


    public function getCityName()
    {
        return $this->cityName;
    }


}