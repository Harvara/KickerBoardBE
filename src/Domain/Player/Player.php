<?php


namespace Domain\Player;


use Domain\City\City;



class Player implements PlayerInterface
{

    /**
     * @var string
     */
    private $playername;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var City
     */
    private $city;

    /**
     * @var int
     */
    private $databaseID;

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


    /**
     * @return string
     */
    public function getPlayername(): string
    {
        return $this->playername;
    }

    /**
     * @param string $playername
     */
    public function setPlayername(string $playername): void
    {
        $this->playername = $playername;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     */
    public function setCity(City $city): void
    {
        $this->city = $city;
    }


    public function getObjectAsJson(): string
    {
        $encodedPlayerData = json_encode(get_object_vars($this));
        $decodedPlayerData = json_decode($encodedPlayerData, true);
        if ($this->city){$decodedPlayerData["city"] = json_decode($this->city->getObjectAsJson());}
        return json_encode($decodedPlayerData);
    }
}
