<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";


$paramIndex = getParameterIndex();
$cityList = [];
$citiesAsJson = [];


if (!$paramIndex){
    //no identifier given, return all cities
    $cityList = getAllCities();
}else{
    switch ($paramIndex) {
        case "id":
            $cityList =   getCityByID();
            break;
        case "name":
            $cityList = getCityByName();
            break;
    }
}


foreach ($cityList as $city){
    array_push($citiesAsJson, json_decode($city->getCityDataAsJson()));
}


echo json_encode($citiesAsJson);


function getAllCities(){
    $cityList = [];
    $cityIDs = getAllCityIDsFromDB();
    foreach ($cityIDs as $cityItem){
        $city = City::withID($cityItem["ID"]);
        array_push($cityList, $city);
    }
    return $cityList;
}


function getCityByID(){
    $cityList = [];
    $id = $_GET["id"];
    array_push($cityList,City::withID($id));
    return $cityList;
}

function getCityByName(){
    $cityList = [];
    $name = $_GET["name"];
    array_push($cityList, City::withDBName($name));
    return $cityList;
}


function dieWithError($message){
    http_response_code(400);
    $json = array(
        "Error"=>$message
    );
    die(json_encode($json));
}


/*
 * return index of parameter in $_GET or false if no param was given
 */
function getParameterIndex(){
    if(isset($_GET["id"])){
        if (validateID()){
            return "id";
        }else{
            dieWithError("InvalidParameter");
        }
    }elseif (isset($_GET["name"])){
        if (validateName()){
            return "name";
        }else{
            dieWithError("Invalid Parameter");
        }
    }elseif (sizeof($_GET)!=0){
        dieWithError("Unknown Parameter");
    }
    return false;
}


function getAllCityIDsFromDB(){
    $pdo = getDBConnection();
    $sql = "Select ID from Cities";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function validateName(){
    $regex = "/^[A-ZÖÄÜ][a-zöäüß]*$/";
    return preg_match($regex, $_GET["name"]);
}

function validateID(){
    $regex = "/^\d+$/";
    return  preg_match($regex,$_GET["id"]);
}


function getDBConnection(){
    $pdo = new DatabaseConnection();
    $pdo = $pdo->create();
    return $pdo;
}