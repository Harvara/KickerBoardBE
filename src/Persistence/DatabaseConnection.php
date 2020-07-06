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

    public function executeSelectStatement(string $statement): array
    {
        // TODO: Implement executeSelectStatement() method.
    }

    public function executeUpdateStatement(string $statement): bool
    {
        // TODO: Implement executeUpdateStatement() method.
    }

    public function executeInsertStatement(string $statement): bool
    {
        // TODO: Implement executeInsertStatement() method.
    }
}
