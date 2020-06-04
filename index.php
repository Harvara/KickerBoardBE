<?php



define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";


echo "Hello Wolrd1";

$player = Player::createDefaultPlayer();

echo $player->getPlayerName();

echo $player->getPlayerDataAsJson();



/*
 * $player->fillPlayerFromDBID(1);
echo $player->getPlayerDataAsJson();
*/
