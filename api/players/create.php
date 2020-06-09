<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";




if(validateParameters()){
    echo "yes";
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