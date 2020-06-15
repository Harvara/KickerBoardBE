<?php


class Team
{
    public $playerA;
    public $playerB;
    public $score;

    public function __construct($playerA, $playerB, $score = 0)
    {
        $this->playerA = $playerA;
        $this->playerB = $playerB;
        $this->score = $score;
    }


}