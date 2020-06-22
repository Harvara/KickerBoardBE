<?php

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept");

define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";


$jsonContent = file_get_contents("php://input");

$matchData = json_decode($jsonContent);


if (validateData($matchData)){
    $match = createMatchFromObject($matchData);
    if (saveMatchToDB($match)){
        echo json_encode(array("Message"=>"Success"));
    }else{
        returnError("Could not save Match");
    }
}else{
    returnError("Invalid Data");
}

function createMatchFromObject($matchData){
    $teamA = createTeamFromJson($matchData->TeamA);
    $teamB = createTeamFromJson($matchData->TeamB);
    return Match::withTeams($teamA, $teamB, $matchData->PlayDate);
}

function saveMatchToDB($match){
    $pdo = getDatabaseConnection();
    $sql = createSQLString();
    $values = createValuesArray($match);
    $statement = $pdo->prepare($sql);
    return $statement->execute($values);
}

function createTeamFromJson($teamData){
    $playerA = Player::withPlayerID($teamData->PlayerIDA);
    $playerB = Player::withPlayerID($teamData->PlayerIDB);
    return new Team($playerA, $playerB, $teamData->Score);
}

function createSQLString(){
    return "Insert into Matches (
                     TeamAPlayerA, 
                     TeamAPlayerB, 
                     TeamBPlayerA, 
                     TeamBPlayerB, 
                     TeamAScore, 
                     TeamBScore, 
                     PlayDate) 
            values (:tAA, :tAB, :tBA, :tBB, :sA, :sB, :playDate)";
}

function createValuesArray($match){
    return array(
        ":tAA"=>$match->teamA->getPlayerA()->getDBID(),
        ":tAB"=>$match->teamA->getPlayerB()->getDBID(),
        ":tBA"=>$match->teamB->getPlayerA()->getDBID(),
        ":tBB"=>$match->teamB->getPlayerB()->getDBID(),
        ":sA"=>$match->teamA->getScore(),
        ":sB"=>$match->teamB->getScore(),
        ":playDate"=>$match->playDate,
    );
}


function validateData($matchData){
    return validateTeam($matchData->TeamA) && validateTeam($matchData->TeamB) && validateDate($matchData->PlayDate);
}


function validateTeam($team){
    return validatePlayer($team->PlayerIDA) && validatePlayer($team->PlayerIDB) && is_numeric($team->Score);
}

function validateDate($date){
    $format = "Y-m-d";
    $testDate = DateTime::createFromFormat($format, $date);
    return $testDate && $testDate->format($format) === $date;
}


function validatePlayer($playerID){
    if (is_numeric($playerID)) {
        $player = Player::withPlayerID($playerID);
        if ($player) {
            return true;
        }
    }
    return false;
}


function getDatabaseConnection(){
    $pdo = new DatabaseConnection();
    return $pdo->create();
}

function preparePDOSelectStatement($pdo, $attribute = false, $value = false){
    if(!$attribute){
        $sql = "select ID from Matches";
        $statement = $pdo->prepare($sql);
    }else{
        $sql = "select ID from Matches where " . $attribute . "= :value";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":value", $value);
    }
    return $statement;
}


function returnError($message){
    http_response_code(400);
    die(json_encode(["Error"=>$message]));
}