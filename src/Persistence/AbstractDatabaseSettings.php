<?php


namespace Kickerboard\Persistence;


class AbstractDatabaseSettings implements DatabseSettingsInterface
{

    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $database;

    public function getConnectionConfig(): array
    {
        return array(
            "host"=>$this->host,
            "user"=>$this->user,
            "password"=>$this->password,
            "database"=>$this->database
        );
    }
}
