<?php


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";


echo "Hello Wolrd";

$city = new City("Jena", 1);

echo $city->getCityName();

