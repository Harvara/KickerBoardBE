<?php


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";


class Player
{
    private $playerName;
    private $firstName;
    private $lastName;
    private $city;
    private $dbID;


    public function __construct($dbContent = false, $userInput = false)
    {
        $instance = new self();
        if ($dbContent){
            $members= $this->createMembersFromDBContent($dbContent);
        }elseif ($userInput){
            $members= $this->createMembersFromUserInput($userInput);
        }else{
            $members= $this->createMembersDefault();
        }
        $instance->fill($members);
        return $instance;
    }

    private  function createMembersDefault(){
        $members = [];
        $members["playerName"]="";
        $members["fistName"]="";
        $members["lastName"]="";
        $members["city"]=null;
        $members["dbID"]=0;
        return $members;
    }

    private function createMembersFromUserInput($userInput){

    }

    private function createMembersFromDBContent($dbContent){
        $members=[];
        $members["playerName"]=$dbContent["Playername"];
        $members["playerName"]=$dbContent["Firstname"];
        $members["playerName"]=$dbContent["Lastname"];
        $members["City"]=City::getCityFromID();
        $members["dbID"]=$dbContent["ID"];

    }
}