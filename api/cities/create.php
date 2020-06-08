<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";



if(validateName() && checkIfNotUsed()){
    $id = getNewDBEntry();
    if (is_int($id)){
        returnAnswer($id);
    }else{
        returnError();
    }
}



private function validateInput(){
    return true;
}


private function checkIfNotUsed(){

}

private function getNewDBEntry(){
    $id = 0;
    return $id;
}


private function returnAnswer($id){

}

private function returnError(){

}