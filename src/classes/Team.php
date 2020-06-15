<?php


class Team
{
    private $playerA;
    private $playerB;
    private $score;

    public function __construct($playerA, $playerB, $score = 0)
    {
        $this->playerA = $playerA;
        $this->playerB = $playerB;
        $this->score = $score;
    }


    public function setScore($score){
        if (is_numeric($score)){
            $this->score= int($score);
        }
    }


    public function getPlayerA()
    {
        return $this->playerA;
    }


    public function getPlayerB()
    {
        return $this->playerB;
    }


    public function getScore()
    {
        return $this->score;
    }



}