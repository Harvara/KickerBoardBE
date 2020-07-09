<?php

namespace Domain;

interface DefaultFactoryInterface
{
    public static function create(string $playerName): DefaultObjectInterface;

    public static function createWithDatabaseID(int $databaseID): DefaultObjectInterface;
}
