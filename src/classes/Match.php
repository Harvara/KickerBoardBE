<?php


class Match
{
    public $teamA;
    public $teamB;
    public $winner;
    private $dbID;

    public  static  function withDBID($dbID){
        $pdo = new DatabaseConnection();
        $pdo = $pdo->create();
        $statement = self::createPDOStatement($dbID, "ID", $pdo);

    }


    private function createPDOStatement($value, $attribute, $pdo){
        $statement = null;
        switch ($attribute){
            case "Playername":
                $sql = "select * from Matches where Playername = :playername";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(":playername", $value);
                break;
            case "ID":
                $sql = "select * from Matches where ID = :id";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(":id", $value);
                break;
            default:
                die("Error");
        }
        return $statement;
    }
}