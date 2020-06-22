<?php

use Symfony\Component\BrowserKit\Request;

class HelloController
{
    /**
     * @var BusinessFactory
     */
    private $businessFactory;

    /**
     * HelloController constructor.
     * @param BusinessFactory $businessFactory
     */
    public function __construct(BusinessFactory $businessFactory)
    {
        $this->businessFactory = $businessFactory;
    }

    public function editAction(Request $request)
    {
        $response = $this->businessFactory->createTeamCityService()->processTeamCity($request);

        return $response;
    }
}
