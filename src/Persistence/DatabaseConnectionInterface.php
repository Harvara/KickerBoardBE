<?php


namespace Persistence;


interface DatabaseConnectionInterface
{
    public function executeSelectStatement(string $sql, array $values):array ;
    public function executeUpdateStatement(string $sql, array $values):bool ;
    public  function executeInsertStatement(string $sql, array $values):bool;
}
