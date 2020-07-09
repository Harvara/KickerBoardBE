<?php


namespace Domain\Match;


use Domain\DefaultObjectInterface;
use Domain\Player\Player;
use Domain\Team\TeamFactory;

class MatchFactory implements MatchFactoryInterface
{

    public static function create(string $playerName): DefaultObjectInterface
    {
        // TODO: Implement create() method.
    }

    public static function createWithDatabaseID(int $databaseID): DefaultObjectInterface
    {
        $data = (new MatchDAO())->get($databaseID);
        return self::createMatchFromArray($data);

    }

    private static function createMatchFromArray(array $data){
        $match = new Match();
        $teamA = TeamFactory::create((int)$data["TeamAPlayerA"],(int)$data["TeamAPlayerB"],(int)$data["TeamAScore"]);
        $teamB = TeamFactory::create((int)$data["TeamBPlayerA"],(int)$data["TeamBPlayerB"],(int)$data["TeamBScore"]);
        $match->setTeamA($teamA);
        $match->setTeamB($teamB);
        $match->setPlayDate($data["PlayDate"]);
        return $match;
    }
}
