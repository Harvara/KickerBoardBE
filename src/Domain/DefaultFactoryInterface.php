<?php

namespace Domain;

use Domain\Player\Player;

interface DefaultFactoryInterface
{
    public static function create(string $playerName): DefaultObjectInterface;

    public static function createWithDatabaseID(int $databaseID): DefaultObjectInterface;
}
