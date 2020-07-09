<?php


namespace Domain\Team;


use Domain\Player\PlayerFactory;

class TeamFactory implements TeamFactoryInterface
{
    public static function create(int $idPlayerA, int $idPlayerB, int $score)
    {
        $playerA = PlayerFactory::createWithDatabaseID($idPlayerA);
        $playerB = PlayerFactory::createWithDatabaseID($idPlayerB);
        $team = new TeamDTO();
        $team->setScore($score);
        $team->setPlayer(0, $playerA);
        $team->setPlayer(1, $playerB);
        return $team;
    }
}
