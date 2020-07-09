<?php


namespace Domain\City;


use Persistence\DatabaseConnection;
use Persistence\DatabaseConnectionFactory;

class CityDAO implements CityDAOInterface
{

    public function get(int $databaseID): array
    {

        $databaseConnection = DatabaseConnectionFactory::create("mysql");
        return $this->getCityDataFromDatabase($databaseConnection, $databaseID);
    }

    public function update(City $City): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $databaseID): bool
    {
        // TODO: Implement delete() method.
    }

    public function create(City $city): bool
    {
        // TODO: Implement create() method.
    }

    private function getCityDataFromDatabase(DatabaseConnection $databaseConnection, int $databaseID): array
    {
        $sql = "select * from Cities where ID= :id";
        $values = array(
            ":id" => $databaseID
        );
        $data = $databaseConnection->executeSelectStatement($sql, $values);
        return $data[0];
    }
}
