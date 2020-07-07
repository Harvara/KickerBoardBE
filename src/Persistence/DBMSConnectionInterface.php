<?php


namespace Persistence;


interface DBMSConnectionInterface
{
    public function prepare(string $sql):void ;
    public function execute(array $values):array ;
}
