<?php


namespace Domain;


interface PlayerInterface
{
    public function createPlayer($player);
    public function deletePlayer($player);
    public function updatePlayer($player);
}