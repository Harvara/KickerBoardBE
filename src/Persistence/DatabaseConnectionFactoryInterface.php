<?php


namespace Kickerboard\Persistence;


interface DatabaseConnectionFactoryInterface
{
    public function create(string $dbms):DatabaseConnection;
}
