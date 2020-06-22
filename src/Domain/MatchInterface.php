<?php


namespace Domain;


interface MatchInterface
{
    public function createGame($name);
    public function updateGame($game);
}