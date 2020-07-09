<?php


namespace Domain\Match;


use Domain\Match\MatchInterface;
use Domain\Team\TeamDTO;

class Match implements MatchInterface
{

    /**
     * @var TeamDTO
     */
    private $teamA;

    /**
     * @var TeamDTO
     */
    private $teamB;

    /**
     * @var string
     */
    private $playDate;

    public function createGame($name)
    {
        // TODO: Implement createGame() method.
    }

    public function updateGame($game)
    {
        // TODO: Implement updateGame() method.
    }

    /**
     * @return TeamDTO
     */
    public function getTeamA(): TeamDTO
    {
        return $this->teamA;
    }

    /**
     * @param TeamDTO $teamA
     */
    public function setTeamA(TeamDTO $teamA): void
    {
        $this->teamA = $teamA;
    }

    /**
     * @return TeamDTO
     */
    public function getTeamB(): TeamDTO
    {
        return $this->teamB;
    }

    /**
     * @param TeamDTO $teamB
     */
    public function setTeamB(TeamDTO $teamB): void
    {
        $this->teamB = $teamB;
    }

    /**
     * @return string
     */
    public function getPlayDate(): string
    {
        return $this->playDate;
    }

    /**
     * @param string $playDate
     */
    public function setPlayDate(string $playDate): void
    {
        $this->playDate = $playDate;
    }



    public function getObjectAsJson(): string
    {
        $teamA = $this->teamA->getObjectAsJson();
        $teamB = $this->teamB->getObjectAsJson();
        $teamA = json_decode($teamA);
        $teamB = json_decode($teamB);
        $match = json_encode(get_object_vars($this));
        $match = json_decode($match, true);
        $match["teamA"] = $teamA;
        $match["teamB"] = $teamB;

        $jsonDate = json_decode(json_encode($this->playDate));
        $match["playDate"] = $jsonDate;

        $match = json_encode($match);
        return $match;
    }
}
