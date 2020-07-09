<?php


namespace Domain\Player;


use Persistence\DatabaseConnection;
use Persistence\DatabaseConnectionFactory;

class PlayerDAO implements PlayerDAOInterface
{

    public function get(int $databaseIndex): array
    {
        $databaseConnection = DatabaseConnectionFactory::create("mysql");
        return $this->getPlayerDataFromDatabase($databaseConnection, $databaseIndex);
    }

    private function getPlayerDataFromDatabase(DatabaseConnection $databaseConnection, int $databaseIndex): array
    {
        $sql = "select * from Players where ID = :id";
        $values = array(
            ":id" => $databaseIndex
        );
        $data = $databaseConnection->executeSelectStatement($sql, $values);
        return $data[0];
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

    public function getAllIDs(): array
    {
        $databaseConnection = DatabaseConnectionFactory::create("mysql");
        $sql = "select ID from Players";
        return $this->createArrayFromDBResult($databaseConnection->executeSelectStatement($sql, array()));
    }

    private function createArrayFromDBResult($data): array
    {
        $idArray = [];
        foreach ($data as $dbEntry) {
            array_push($idArray, $dbEntry["ID"]);
        }
        return $idArray;
    }
}
