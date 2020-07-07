<?php


namespace Kickerboard\Persistence;


class DatabaseConnection implements DatabaseConnectionInterface
{
    /**
     * @var DBMSConnectionInterface
     */
    private $dbmcConnection;

    public function __construct(DBMSConnectionInterface $dbmsconnection)
    {
        $this->dbmcConnection = $dbmsconnection;
    }

    public function executeSelectStatement(string $sql, array $values): array
    {
        if (! $this->dbmcConnection){
            die("No Connection set");
        }
        $this->dbmcConnection->prepare($sql);
        return $this->dbmcConnection->execute($values);
    }

    public function executeUpdateStatement(string $statement, array $values): bool
    {
        // TODO: Implement executeUpdateStatement() method.
    }

    public function executeInsertStatement(string $statement, array $values): bool
    {
        // TODO: Implement executeInsertStatement() method.
    }
}
