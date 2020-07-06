<?php


namespace Kickerboard\Domain\Factory;


interface DBFactoryInterface
{
    public function createFromID(int $id);
}
