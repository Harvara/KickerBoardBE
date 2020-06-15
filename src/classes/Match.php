<?php


class Match
{
    public $teamA;
    public $teamB;
    private $dbID;

    public function __construct()
    {
    }

    public static function withDBID($dbID){

    }

    public static function withTeams($teamA, $teamB){

    }

    public function setTeamA($playerA, $playerB, $score){
            if (
                $playerA instanceof Player &&
                $playerB instanceof Player
            ){
                $this->createTeamFromPlayerObjects($playerA, $playerB, "A");
            }elseif (
                gettype($playerA)=='integer' &&
                gettype($playerB)=='integer'
            ){
                $this->createTeamFromPlayerIDs($playerA, $playerB, "A");
            }elseif (
                gettype($playerA)=='string' &&
                gettype($playerB)=='string'
            ){
                $this->createTeamFromPlayerNames($playerA, $playerB, "A");
            }else{
                return null;
            }
    }

    private  function  createTeamFromPlayerObjects($playerA, $playerB, $teamString){
        $team =  new Team($playerA, $playerB);
        if ($team){
            switch ($teamString){
                case 'A':
                    $this->teamA=$team;
                    break;
                case 'B':
                    $this->teamB=$team;
                    break;
            }
        }
    }

    private  function createTeamFromPlayerIDs($playerIdA, $playerIdB, $teamString){
        $playerA = Player::withPlayerID($playerIdA);
        $playerB = Player::withPlayerID($playerIdB);
        if ($playerA && $playerB) {
            $team = new Team($playerA, $playerB);
            switch ($teamString){
                case 'A':
                    $this->teamA=$team;
                    break;
                case 'B':
                    $this->teamB=$team;
                    break;
            }
        }
    }

    private function createTeamFromPlayerNames($playerNameA, $playerNameB, $teamString){
        $playerA = Player::withPlayername($playerNameA);
        $playerB = Player::withPlayername($playerNameB);
        if ($playerA && $playerB) {
            $team = new Team($playerA, $playerB);
            switch ($teamString){
                case 'A':
                    $this->teamA=$team;
                    break;
                case 'B':
                    $this->teamB=$team;
                    break;
            }
        }
    }




}