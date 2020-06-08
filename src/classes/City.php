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
        $members = $instance->createMembersFromDBContent($dbContent);
        $instance->fill($members);
        return $instance;
    }


    public  static function withName($cityName){
        $instance = new self();
        $dbContent = $instance->getCityFromDB($cityName, "Name");
        $members = $instance->createMembersFromDBContent($dbContent);
        $instance->fill($members);
        return $instance;
    }


    private function getCityFromDB($value,$attribute){
        $pdo = new DatabaseConnection();
        $pdo = $pdo ->create();
        if (!$value || !$attribute){
            $sql = "Select * from Cities";
            $statement = $pdo->prepare($sql);
            $statement->execute();
        }else{
            $sql = "Select * from Cities where :attribute=:value";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(
                ":attribute"=>$attribute,
                ":value"=>$value
            ));
        }
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }




    private function createMembersFromDBContent($dbContent){
        $members = [];
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