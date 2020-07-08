<?php


namespace Domain\Player;


interface PlayerFacadeInterface
{
    public function getSinglePlayer(int $playerID) : Player;
    public function getAllPlayers():array ;
    public function deletePlayer(int $playerID):bool ;
    public function createPlayer(Player $player):bool ;
    public function updatePlayer(Player $player):bool ;
}
