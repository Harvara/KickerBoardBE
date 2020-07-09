<?php

namespace Domain\Match;

interface MatchFacadeInterface
{
    public function getSingleMatch(int $matchID): Match;

    public function getAllMatches(): array;

    public function deleteMatch(int $matchID): bool;

    public function createMatch(Match $match): bool;

    public function updateMatch(Match $match): bool;
}
