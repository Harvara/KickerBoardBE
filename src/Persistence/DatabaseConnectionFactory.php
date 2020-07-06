<?php


namespace Kickerboard\Persistence;


class DatabaseConnectionFactory implements DatabaseConnectionFactoryInterface
{
    const DBMS = ["mysql"];


    public function create(string $dbms): DatabaseConnection
    {
        if (!in_array($dbms, self::DBMS)){
            die("No DBMS Error");
        }
        return $this->buildConnectionWithDBMS($dbms);

    }

    public function buildConnectionWithDBMS($dbms): DatabaseConnection{
        switch ($dbms){
            case "mysql":
                return new DatabaseConnection(new MysqlConnection());
        }
    }
}
