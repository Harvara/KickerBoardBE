<?php


namespace Persistence;


interface DatabaseConnectionFactoryInterface
{
    public static function  create(string $dbms):DatabaseConnection;
}
