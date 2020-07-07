<?php


namespace Persistence;


class DatabaseConnectionFactory implements DatabaseConnectionFactoryInterface
{
    const DBMS = ["mysql"];


    public static function create(string $dbms): DatabaseConnection
    {
        if (!in_array($dbms, self::DBMS)){
            die("No DBMS Error");
        }
        return self::buildConnectionWithDBMS($dbms);

    }

    private static function buildConnectionWithDBMS($dbms): DatabaseConnection{
        switch ($dbms){
            case "mysql":
                return new DatabaseConnection(new MysqlConnection(DatabaseSettings::getConnectionConfig()));
        }
    }
}
