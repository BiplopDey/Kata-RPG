<?php

namespace App\Rules;
use App\Character;

class Rules {
    private Character $character;
    public function __construct(Character $character)
    {
        $this->character = $character;
    }
    public function canHit(Character $victim): bool{
        return $this->character !== $victim 
        && $this->character->isNearRange($victim)
        && !$this->checkAlly($victim);
    }

    public function canHeal(float $health, Character $healed)
    {
        // healed must be alive and the healer cannot give more heath than he has
        return $healed->isAlive() 
        
        && $this->character != $healed
        && $this->character->getHealth() > $health 
        && $this->character !== $healed 
        && $this->character->isNearRange($healed)
        && $this->checkAlly($healed);
    }

    private function checkAlly(Character $ch): bool{
        if(array_intersect($this->character->getFactions(),$ch->getFactions()))
            return true;
        return false;
    }
}