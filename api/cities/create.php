<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";




if(
    validateName() &&
    checkIfNotUsed()){
        $city = getNewDBEntry();
        if(!$city){
            returnError("Could not create city");
        }else{
            returnCityCreated($city);
        }
}else{
    returnError("Invalid Parameter");
}




function checkIfNotUsed(){
    if(!City::withDBName($_GET["name"])){
        return true;
    } else{
        return false;
    }
}

function getNewDBEntry(){
    if (City::createNewWithName($_GET["name"])){
        return City::withDBName($_GET["name"]);
    }
    return false;
}


function returnCityCreated($city){
    echo $city->getCityDataAsJson();
}

function returnError($message){
    http_response_code(400);
    echo json_encode(["Error"=>$message]);
}


function validateName(){
    return City::validateName($_GET["name"]);
}