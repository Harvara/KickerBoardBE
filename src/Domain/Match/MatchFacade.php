<?php


namespace Domain\Match;


class MatchFacade implements MatchFacadeInterface
{
    public function getSingleMatch(int $matchID):Match
    {
        return MatchFactory::createWithDatabaseID($matchID);
    }

    public function getAllMatches():array
    {

    }

    public function deleteMatch(int $matchID):bool
    {

    }

    public function createMatch(Match $match):bool
    {

    }

    public function updateMatch(Match $match):bool
    {

    }
}
