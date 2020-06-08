<?php

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";

echo "test";



/*
if (!$_GET["id"]){
    getCityByID();
}
*/
function getCityByID(){
    if (validateInput()){

    }else{
        die(dieWithError("Invalid Parameter"));
    }
}


function dieWithError($message){
    http_response_code(400);
    $json = array(
        "Error"=>$message
    );
    die(json_encode($json));
}

function getGivenInput(){
    if(
        isset($_GET["id"]) &&
        is_int($_GET["id"])
    ){
        return "ID";
    }elseif (
        isset($_GET["name"]) &&
        validateName()
    ){
        return "NAME";
    }
    dieWithError("Parameter has wrong type");
}


function validateName(){
    $regex = "^[A-ZÖÄÜ][a-zöäüß]*$";
    return preg_match($regex, $_GET["name"]);
}
