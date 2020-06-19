<?php

use Domain\CityInterface;
use Symfony\Component\BrowserKit\Request;

class TeamCityService
{
    /**
     * @var Team
     */
    private $team;
    /**
     * @var CityInterface
     */
    private $city;

    /**
     * TeamCityService constructor.
     * @param Team $team
     * @param City $city
     */
    public function __construct(Team $team, City $city)
    {
        $this->team = $team;
        $this->city = $city;
    }

    public function processTeamCity(Request $request) {

    }
}
