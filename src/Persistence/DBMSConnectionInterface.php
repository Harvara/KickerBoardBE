<?php


namespace Kickerboard\Persistence;


use _generated\AcceptanceTesterActions;

interface DBMSConnectionInterface
{
    public function prepare(string $sql):void ;
    public function execute(array $values):array ;
}
