<?php

class City
{
    private $cityName;
    private $dbID;

    public function __construct()
    {
    }


    public static function createCityFromID($dbid){
        $instance = new self();
        $dbContent = $instance->getCityfromDBID($dbid);
        $members = $instance->createMembersFromDBContent($dbContent);
        $instance->fill($members);
        return $instance;
    }

    private function getCityfromDBID($dbid){
        $pdo = new DatabaseConnection();
        $pdo = $pdo->create();
        $sql="select * from Cities where ID=:id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id",$dbid, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    private function createMembersFromDBContent($dbContent){
        $members = [];
        $members["dbID"]=$dbContent["ID"];
        $members["cityName"]=$dbContent["Name"];
        return $members;
    }

    public function getCityAsJson(){
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