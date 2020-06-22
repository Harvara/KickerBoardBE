<?php


namespace Domain\TeamInterface;


interface TeamInterface
{
    public function createTeam($team);
    public function deleteTeam($team);
}