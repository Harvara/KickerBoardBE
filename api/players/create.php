<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";




if(validateParameters()){
    if(createDBEntry()){
        returnSuccess();
    }else{
        returnError("Could not create Player");
    }
}else{
    returnError("Invalid Parameter");
}


function validateParameters(){
    return (
        Player::validateName($_GET["firstname"]) &&
        Player::validateName($_GET["lastname"]) &&
        Player::validatePlayerName($_GET["playername"]) &&
        City::validateName($_GET["city"])
    );
}

function returnError($message){
    http_response_code(400);
    echo json_encode(["Error"=>$message]);
}

function returnSuccess(){
    $player = Player::withPlayername($_GET["playername"]);
    if ($player){
        echo $player->getPlayerDataAsJson();
    }else{
        returnError("An Error occured");
    }
}

function getCityID(){
    $city = City::withDBName($_GET["city"]);
    return $city->getDBID();
}


function createDBEntry(){
    $pdo = getDBConnection();
    $statement = prepareStatement($pdo);
    $valuesArray = createValuesArray();
    if ($statement->execute($valuesArray)) return true;
    return false;
}

function createValuesArray(){
    $cityID = getCityID();
    $values = array(
        ":playername" => $_GET["playername"],
        ":firstname" => $_GET["firstname"],
        ":lastname" => $_GET["lastname"],
        ":cityid" => $cityID
    );
    return $values;
}

function prepareStatement($pdo){
    $sql = "Insert into Players (Playername, Firstname, Lastname, CityID) 
            values (:playername, :firstname, :lastname, :cityid)";
    $statement = $pdo->prepare($sql);
    return $statement;
}


function getDBConnection(){
    $pdo = new DatabaseConnection();
    $pdo = $pdo->create();
    return $pdo;

}