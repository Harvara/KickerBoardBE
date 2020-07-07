<?php


namespace Kickerboard\Domain\City;


use Domain\City\City;
use Kickerboard\Persistence\DatabaseConnection;
use Kickerboard\Persistence\DatabaseConnectionFactory;

class CityDAO implements CityDAOInterface
{

    public function get($databaseID): array
    {
        $databaseConnection = DatabaseConnectionFactory::create("mysql");
        return $this->$this->getCityDataFromDatabase($databaseConnection, $databaseID);
    }

    public function update(City $City): bool
    {
        // TODO: Implement update() method.
    }

    public function delete($databaseID): bool
    {
        // TODO: Implement delete() method.
    }

    public function create(City $city): bool
    {
        // TODO: Implement create() method.
    }

    private function getCityDataFromDatabase(DatabaseConnection $databaseConnection, int $databaseID ):array {
        $sql = "select * from Cities where ID= :id";
        $values = array(
            ":id" => $databaseID
        );
        return $databaseConnection->executeSelectStatement($sql, $values);
    }
}
