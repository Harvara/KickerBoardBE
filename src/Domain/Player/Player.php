<?php


namespace Domain\Player;


use Domain\City\City;
use Domain\Player\PlayerInterface\PlayerInterface;


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


}
