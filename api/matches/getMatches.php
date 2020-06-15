<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";

$paramIndex = getParameterIndex();

if(!$paramIndex){
    allMatchesRequested();
}else{
    switch ($paramIndex){
        case "id":
            matchRequestedByID();
            break;
        case "date":
            matchesRequestedByDate();
            break;
    }
}



function getParameterIndex(){
    if(isset($_GET["id"])){
        if (validateID()){
            return "id";
        }else{
            returnErrorCode("Invalid Parameter or Match not found");
        }
    }elseif (isset($_GET["date"])){
        if (validateDate($_GET["date"])){
            return "date";
        }else{
            returnError("Invalid Parameter or Match not found");
        }
    }elseif (sizeof($_GET)!=0){
        returnErrorCode("Unknown Parameter");
    }
    return false;
}


function allMatchesRequested(){
    $matchList = getAllMatches();
    $matchesAsJson =  [];
    foreach ($matchList as $match){
        array_push($matchesAsJson, json_decode($match->getMatchDataAsJson()));
    }
    echo json_encode($matchesAsJson);
}


function getAllMatches(){
    $pdo = getDatabaseConnection();
    $statement = preparePDOStatement($pdo);
    $statement->execute();
    return createMatchesFromDBIDs($statement->fetchAll(PDO::FETCH_ASSOC));
}


function createMatchesFromDBIDs($dbContent){
    $matches = [];
    foreach ($dbContent as $matchRow){
        array_push($matches, Match::withDBID($matchRow["ID"]));
    }
    return $matches;
}

function getDatabaseConnection(){
    $pdo = new DatabaseConnection();
    return $pdo->create();
}

function preparePDOStatement($pdo, $attribute = false, $value = false){
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

//Date given in Format DDMMYYYY
function createDate($dateString){
    $dayPart = int(substr($dateString, 0, 2));
    $monthPart = int(substr($dateString, 2, 2));
    $yearPart = int(substr($dateString, 4, 4));
    if (
        ($dayPart > 0 && $dayPart<32) &&
        ($monthPart > 0 && $dayPart<12) &&
        ($yearPart > 1970 && $dayPart<2030)
    ){
        $unixTimestamp = strtotime($dayPart . "." . $monthPart . "." . $yearPart);
        return date("d.m.Y", $unixTimestamp);
    }
    return null;
}

function validateDate($dateString){
    if (createDate($dateString)){
        return true;
    }else{
        return false;
    }
}

function validateID(){
    $regex = "/^\d+$/";
    return  preg_match($regex,$_GET["id"]);
}


function returnError($message){
    http_response_code(400);
    die(json_encode(["Error"=>$message]));
}