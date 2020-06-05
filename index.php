<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";



$player = Player::createDefaultPlayer();


echo $player->getPlayerDataAsJson();



/*
 * $player->fillPlayerFromDBID(1);
echo $player->getPlayerDataAsJson();
*/
