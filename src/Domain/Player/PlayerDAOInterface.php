<?php


namespace Domain\PLayer;



interface PlayerDAOInterface
{
    public function get(int $databaseIndex):array;
    public function getAllIDs():array;
    public function update(Player $player);
    public function delete(int $databaseID);
    public function create(Player $player);
}
