<?php

namespace Domain\Team;

interface TeamFactoryInterface
{
    public static function create(int $idPlayerA, int $idPlayerB, int $score);
}
