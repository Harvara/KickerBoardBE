<?php

namespace Domain\Match;

interface MatchDAOInterface
{
    public function get(int $databaseID): array;

    public function update(Match $match): bool;

    public function delete(int $dbID): bool;

    public function create(Match $match): bool;

    public function getAllIDs(): array;
}
