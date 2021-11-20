<?php

namespace App\Rules;
use App\Character;

class Rules {
    private $character;
    public function __construct(Character $character)
    {
        $this->character = $character;
    }
    public function canHit(Character $victim): bool{
        return $this->character !== $victim && $this->character->isNearRange($victim);
    }
}