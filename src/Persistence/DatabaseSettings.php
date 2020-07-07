<?php


namespace Persistence;


class DatabaseSettings implements DatabaseSettingsInterface
{

    private static $host = "localhost";
    private static $database = "Kickerboard";
    private static $user = "user";
    private static $password = "password";


    public static function getConnectionConfig(): array
    {
        return array(
            "host"=> self::$host,
            "databse"=>self::$database,
            "user"=>self::$user,
            "password"=>self::$password
        );
    }
}
