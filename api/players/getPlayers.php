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
    $playersFromDB = getPlayersArrayFromDB($pdo);
    return createPlayersFromArray($playersFromDB);
}


function createPlayersFromArray($playersFromDB){
    $playerList = [];
    foreach ($playersFromDB as $playerItem){
        $newPlayer = Player::withDBContent($playerItem);
        array_push($playerList,$newPlayer);
    }
    return $playerList;
}


function getPlayersArrayFromDB($pdo){
    $sql = "Select * from Players";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getDBConnection(){
    $pdo = new DatabaseConnection();
    $pdo = $pdo->create();
    return $pdo;
}