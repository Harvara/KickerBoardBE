<?php


namespace Kickerboard\Persistence;


interface DatabaseConnectionInterface
{
    public function executeSelectStatement(string $statement):array ;
    public function executeUpdateStatement(string $statement):bool ;
    public  function executeInsertStatement(string $statement):bool;
}
