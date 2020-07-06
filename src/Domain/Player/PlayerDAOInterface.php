<?php


namespace Kickerboard\Domain\Player;


use Domain\Player\Player;

interface PlayerDAOInterface
{
    public function get(int $databaseIndex):array;
    public function update(Player $player);
    public function delete(int $databaseID);
    public function create(Player $player);
}
