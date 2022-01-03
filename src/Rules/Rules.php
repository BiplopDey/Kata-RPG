<?php

namespace App\Rules;
use App\Character;
use App\Entity;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\returnSelf;

class Rules {
    private Character $character;
    
    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function canHit(Entity $victim): bool
    {
        return $this->character !== $victim 
            && $this->character->isNearRange($victim)
            && $this->checkAttakable($victim);
    }
    
    // healed must be alive and the healer cannot give more heath than he has
    public function canHeal(float $health, Character $healed)
    {
        return $healed->isAlive() 
            && $this->character->getHealth() > $health 
            && $this->character !== $healed 
            && $this->character->isNearRange($healed)
            && $this->checkAlly($healed);
    }

    private function checkAttakable(Entity $victim): bool
    {
        return $victim instanceof Character ? !$this->checkAlly($victim) : true;
    }

    private function checkAlly(Character $ch): bool
    {
        $commonFactions = array_intersect($this->character->getFactions(), $ch->getFactions());
        return !empty($commonFactions);
    }
}