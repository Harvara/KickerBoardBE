<?php


namespace Domain\MatchInterface;


interface MatchInterface
{
    public function createGame($name);
    public function updateGame($game);
}