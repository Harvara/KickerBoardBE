<?php


namespace Domain\Team;


use Domain\Player\Player;
use Domain\TeamInterface\TeamDTOInterface;

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


    public function getPlayer(int $index): Player
    {
        // TODO: Implement getPlayer() method.
    }

    public function setPlayer(int $index, Player $player)
    {
        // TODO: Implement setPlayer() method.
    }

    public function getScore(): int
    {
        // TODO: Implement getScore() method.
    }

    public function setScore(int $score)
    {
        // TODO: Implement setScore() method.
    }
}
