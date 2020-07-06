<?php


namespace Kickerboard\Persistence;


interface DatabaseConnectionInterface
{
    public function executeSelectStatement(string $statement, array $values):array ;
    public function executeUpdateStatement(string $statement, array $values):bool ;
    public  function executeInsertStatement(string $statement, array $values):bool;
}
