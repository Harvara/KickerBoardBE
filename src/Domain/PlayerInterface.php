<?php


namespace Domain\PlayerInterface;


interface PlayerInterface
{
    public function createPlayer();
    public function deletePlayer($player);
    public function updatePlayer($player);
}