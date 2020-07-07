<?php


namespace Persistence;


class DatabaseSettings implements DatabaseSettingsInterface
{

    private static $host = "localhost";
    private static $database = "Kickerboard";
    private static $user = "henry";
    private static $password = "P@ssword";


    public static function getConnectionConfig(): array
    {
        return array(
            "host"=> self::$host,
            "database"=>self::$database,
            "user"=>self::$user,
            "password"=>self::$password
        );
    }
}
