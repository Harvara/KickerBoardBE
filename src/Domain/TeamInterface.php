<?php


namespace Domain;


interface TeamInterface
{
    public function createTeam($team);
    public function deleteTeam($team);
}