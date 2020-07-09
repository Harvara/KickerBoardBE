<?php


namespace Domain\Team;


use Domain\DefaultObjectInterface;
use Domain\Player\Player;

interface TeamDTOInterface extends DefaultObjectInterface
{
    public function getPlayer(int $index): ?Player;

    public function setPlayer(int $index, Player $player);

    public function getScore(): int;

    public function setScore(int $score);
}
