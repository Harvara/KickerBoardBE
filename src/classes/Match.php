<?php


class Match
{
    public $teamA;
    public $teamB;
    public $playDate;
    private $dbID;

    public function __construct()
    {
    }

    public static function withDBID($dbID){
        return self::createMatchFromDBID($dbID);

    }

    public static function withTeams($teamA, $teamB){
        $instance = new self();
        $instance->$teamA = $teamA;
        $instance->$teamB = $teamB;
        return $instance;
    }

    //$players can be dbIDs, playernames or objects
    public function setTeam($playerA, $playerB, $teamString, $score = null){
            if (
                $playerA instanceof Player &&
                $playerB instanceof Player
            ){
                $team =createTeamFromPlayerObjects($playerA, $playerB, $teamString);
            }elseif (
                gettype($playerA)=='integer' &&
                gettype($playerB)=='integer'
            ){
                $team = createTeamFromPlayerIDs($playerA, $playerB, $teamString);
            }elseif (
                gettype($playerA)=='string' &&
                gettype($playerB)=='string'
            ){
                $team = createTeamFromPlayerNames($playerA, $playerB);
            }
            if($team){
                switch ($teamString){
                    case 'A':
                        $this->teamA=$team;
                        break;
                    case 'B':
                        $this->teamB=$team;
                        break;
                }
            }
            if ($score){
                $this->setScore($score);
            }
    }


    public function setScore($score){
        if (sizeof($score)==2){
            $this->teamA->setScore($score[0]);
            $this->teamB->setScore($score[1]);
        }
    }

    private  function  createTeamFromPlayerObjects($playerA, $playerB){
        return  new Team($playerA, $playerB);
    }

    private  function createTeamFromPlayerIDs($playerIdA, $playerIdB){
        $playerA = Player::withPlayerID($playerIdA);
        $playerB = Player::withPlayerID($playerIdB);
        if ($playerA && $playerB) {
            return new Team($playerA, $playerB);
        }
        return null;
    }

    private function createTeamFromPlayerNames($playerNameA, $playerNameB){
        $playerA = Player::withPlayername($playerNameA);
        $playerB = Player::withPlayername($playerNameB);
        if ($playerA && $playerB) {
            return new Team($playerA, $playerB);
        }
        return null;
    }

    private function createMatchFromDBID($dbID){
        $pdo = $this->createDataBaseConnection();
        $statement = $this->createPDOSelectStatement($pdo, $dbID);
        $statement->execute();
        $dbContent = $statement->fetch(PDO::FETCH_ASSOC);
        if (sizeof($dbContent)==1){
            return  $this->createMatchFromDBContent($dbContent);
        }else{
            return null;
        }
    }

    private function createDataBaseConnection(){
        $pdo = new DatabaseConnection();
        $pdo = $pdo->create();
        return $pdo;
    }

    private function createPDOSelectStatement($pdo, $dbID){
        $sql = "select * from Matches where ID = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $dbID);
        return $statement;
    }


    private function createMatchFromDBContent($dbContent){
        $teamA = $this->createTeamFromPlayerIDs($dbContent["TeamAPlayerA"], $dbContent["TeamAPlayerB"]);
        $teamB = $this->createTeamFromPlayerIDs($dbContent["TeamAPlayerA"], $dbContent["TeamAPlayerB"]);
        $teamA->setScore($dbContent["TeamAScore"]);
        $teamB->setScore($dbContent["TeamBScore"]);
        $match = Match::withTeams($teamA, $teamB);
        $match->playDate = $dbContent["PlayDate"];
        return $match;
    }

}