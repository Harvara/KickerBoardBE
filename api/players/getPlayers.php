<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";


$paramIndex = getParameterIndex();



if (!$paramIndex){
    //no identifier given, return all cities
    allPlayersRequested();
}else{
    switch ($paramIndex) {
        case "id":
            playerRequestedByID();
            break;
        case "name":
            playerRequestedByName();
            break;
    }
}


function allPlayersRequested(){
    $playerList = generatePlayerList();
    $playersAsJson =[];

    foreach ($playerList as $player){
        array_push($playersAsJson,json_decode($player->getPlayerDataAsJson()));
    }
    echo json_encode($playersAsJson);
}


function playerRequestedByID(){
    $player = Player::withPlayerID($_GET["id"]);
    if (!$player){
        returnError("Could not find player");
    }else{
        echo $player->getPlayerDataAsJson();
    }
}



function playerRequestedByName(){
    $player = Player::withPlayername($_GET["name"]);
    if (!$player){
        returnError("Could not find player");
    }else{
        echo $player->getPlayerDataAsJson();
    }
}



function generatePlayerList(){
    $pdo = getDBConnection();
    $playerNamesFromDB = getPlayerNameArrayFromDB($pdo);
    return createPlayersFromArray($playerNamesFromDB);
}


function createPlayersFromArray($playerNamesFromDB){
    $playerList = [];
    foreach ($playerNamesFromDB as $playerName){
        $newPlayer = Player::withPlayername($playerName["Playername"]);
        array_push($playerList,$newPlayer);
    }
    return $playerList;
}


function getPlayerNameArrayFromDB($pdo){
    $sql = "Select Playername from Players";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getDBConnection(){
    $pdo = new DatabaseConnection();
    $pdo = $pdo->create();
    return $pdo;
}

function getParameterIndex(){
    if(isset($_GET["id"])){
        if (validateID()){
            return "id";
        }else{
            returnErrorCode("Invalid Parameter or Player not found");
        }
    }elseif (isset($_GET["name"])){
        if (Player::validatePlayerName($_GET["name"])){
            return "name";
        }else{
            returnError("Invalid Parameter or Player not found");
        }
    }elseif (sizeof($_GET)!=0){
        returnErrorCode("Unknown Parameter");
    }
    return false;
}


function validateID(){
    $regex = "/^\d+$/";
    return  preg_match($regex,$_GET["id"]);
}


function returnError($message){
    http_response_code(400);
    die(json_encode(["Error"=>$message]));
}