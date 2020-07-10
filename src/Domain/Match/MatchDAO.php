<?php


namespace Domain\Match;


use Persistence\DatabaseConnection;
use Persistence\DatabaseConnectionFactory;

class MatchDAO implements MatchDAOInterface
{
    public function get(int $databaseID): ?array
    {
        $databaseConnection = DatabaseConnectionFactory::create("mysql");
        return $this->getMatchFromDatabase($databaseConnection, $databaseID);
    }

    public function update(Match $match): bool
    {

    }

    public function delete(int $dbID): bool
    {

    }

    public function create(Match $match): bool
    {

    }

    public function getAllIDs(): array
    {

    }

    private function getMatchFromDatabase(DatabaseConnection $databaseConnection, int $databaseID): ?array
    {
        $sql = "select * from Matches where ID = :id";
        $values = array(
            ":id" => $databaseID
        );
        $data = $databaseConnection->executeSelectStatement($sql, $values);
        return $data[0];
    }

}
