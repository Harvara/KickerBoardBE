<?php

namespace Domain\City;

class City implements CityInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $databaseID;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getDatabaseID(): int
    {
        return $this->databaseID;
    }

    /**
     * @param int $databaseID
     */
    public function setDatabaseID(int $databaseID): void
    {
        $this->databaseID = $databaseID;
    }


}
