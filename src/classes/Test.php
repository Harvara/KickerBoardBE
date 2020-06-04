<?php


class Test
{
    private $testVar;

    /**
     * Test constructor.
     * @param $testVar
     */
    public function __construct()
    {
        $this->testVar = new Test2("Val");
    }

    /**
     * @return mixed
     */
    public function getTestVar()
    {
        return $this->testVar->getVal();
    }



}