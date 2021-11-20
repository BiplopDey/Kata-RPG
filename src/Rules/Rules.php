<?php

namespace App\Rules;
use App\Character;
use App\Entity;

use function PHPUnit\Framework\returnSelf;

class Rules {
    private Character $character;
    public function __construct(Character $character)
    {
        $this->character = $character;
    }
    public function canHit(Entity $victim): bool{
        return $this->character !== $victim 
        && $this->character->isNearRange($victim)
        && $this->checkAttakable($victim);
    }

    public function canHeal(float $health, Character $healed)
    {
        // healed must be alive and the healer cannot give more heath than he has
        return $healed->isAlive() 
        && $this->character->getHealth() > $health 
        && $this->character !== $healed 
        && $this->character->isNearRange($healed)
        && $this->checkAlly($healed);
    }

    private function checkAttakable(Entity $victim): bool{
        if($victim instanceof Character)
        return !$this->checkAlly($victim);

        return true;
    }

    private function checkAlly(Character $ch): bool{
        if(array_intersect($this->character->getFactions(),$ch->getFactions()))
            return true;
        return false;
    }
}