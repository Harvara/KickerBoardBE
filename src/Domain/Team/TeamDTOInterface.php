<?php


namespace Domain\TeamInterface;


use Domain\Player\Player;

interface TeamDTOInterface
{
    public function getPlayer(int $index):Player;
    public function setPlayer(int $index, Player $player);
    public function getScore():int;
    public function setScore(int $score);
}
