<?php


namespace Kickerboard\Persistence;

use PDO;

class MysqlConnection implements DBMSConnectionInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(array $config)
    {
        $connectionString = "mysql:host=".$config["host"].";dbname".$config["database"];
        $this->pdo = new PDO(
            $connectionString,
            $config["user"],
            $config["password"]
        );
    }
}
