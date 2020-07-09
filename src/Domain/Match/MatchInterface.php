<?php


namespace Domain\Match;

use Domain\DefaultObjectInterface;

interface MatchInterface extends DefaultObjectInterface
{
    public function createGame($name);
    public function updateGame($game);
}
