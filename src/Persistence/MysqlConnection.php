<?php


namespace Persistence;

use PDO;

class MysqlConnection implements DBMSConnectionInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var \PDOStatement
     */
    private $statment;

    public function __construct(array $config)
    {
        $connectionString = "mysql:host=".$config["host"].";dbname=".$config["database"];
        $this->pdo = new PDO(
            $connectionString,
            $config["user"],
            $config["password"]
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function prepare(string  $sql):void {
        $this->statment = $this->pdo->prepare($sql);
    }

    public function execute(array $values): array
    {
        $this->statment->execute($values);
        return $this->statment->fetchAll(PDO::FETCH_ASSOC);
    }
}
