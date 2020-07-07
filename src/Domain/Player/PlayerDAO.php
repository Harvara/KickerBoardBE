<?php


namespace Kickerboard\Domain\Player;


use Domain\Player\Player;
use Kickerboard\Persistence\DatabaseConnection;
use Kickerboard\Persistence\DatabaseConnectionFactory;
use phpDocumentor\Reflection\Types\This;

class PlayerDAO implements PlayerDAOInterface
{

    public function get(int $databaseIndex): array
    {
        $databaseConnection = DatabaseConnectionFactory::create("mysql");
        return $this->getPlayerDataFromDatabase($databaseConnection, $databaseIndex);
    }

    public function update(Player $player)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $databaseID)
    {
        // TODO: Implement delete() method.
    }

    public function create(Player $player)
    {
        // TODO: Implement create() method.
    }


    private function getPlayerDataFromDatabase(DatabaseConnection $databaseConnection, int $databaseIndex):array {
        $sql = "select * from Players where ID = :id";
        $values = array(
            ":id"=>$databaseIndex
        );
        return $databaseConnection->executeSelectStatement($sql, $values );
    }
}
