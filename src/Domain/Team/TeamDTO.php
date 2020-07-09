<?php


namespace Domain\Team;


use Domain\Player\Player;

class TeamDTO implements TeamDTOInterface
{
    /**
     * @var Player
     */
    private $playerA;

    /**
     * @var Player
     */
    private $playerB;

    /**
     * @var int
     */
    private $score;


    public function getPlayer(int $index): ?Player
    {
        if ($index===0){
            return $this->playerA;
        }
        elseif ($index===1){
            return $this->playerB;
        }
        else{
            return null;
        }
    }

    public function setPlayer(int $index, Player $player)
    {
        switch ($index){
            case 0:
                $this->playerA = $player;
                break;
            case 1:
                $this->playerB = $player;
                break;
            default:
                break;
        }
    }

    public function getScore(): int
    {
        // TODO: Implement getScore() method.
    }

    public function setScore(int $score)
    {
        $this->score = $score;
    }

    public function getObjectAsJson(): string
    {
        $jsonPlayerA = json_decode($this->playerA->getObjectAsJson());
        $jsonPlayerB = json_decode($this->playerB->getObjectAsJson());
        $jsonScore = json_decode(json_encode($this->score));
        $team = json_encode(get_object_vars($this));
        $team = json_decode($team,true);
        $team["playerA"]=$jsonPlayerA;
        $team["playerB"]=$jsonPlayerB;
        $team["score"]=$jsonScore;
        return json_encode($team);

    }
}
