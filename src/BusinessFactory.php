<?php

class BusinessFactory
{
    public function createTeamCityService() : TeamCityService
    {
        return new TeamCityService();
    }
}
