<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";


$playerList = generatePlayerList();

$playersAsJson =[];


foreach ($playerList as $player){
    array_push($playersAsJson,json_decode($player->getPlayerDataAsJson()));
}


echo json_encode($playersAsJson);


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