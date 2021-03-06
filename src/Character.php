<?php

namespace App;
use App\Fighter\Type;
use App\Fighter\Melee;
use App\Geometry\Point;
use App\Faction\Factions;
use App\Rules\Rules;
use App\Entity;
class Character extends Entity
{
    private Type $type;
    private float $maxAttack;
    private Rules $rules;
    private Factions $factions;

    public function __construct() 
    {
        parent::__construct(1000, 1, new Point(0,0));
        $this->factions = new Factions();
        $this->type = new Melee();
        $this->range = $this->type->getRange();
        $this->rules = new Rules($this);
    }

    public function hit(float $damage, Entity $victim): void
    {
        if(!$this->rules->canHit($victim))
            return;
        
        $victim->takeHealth($this->getDamage($damage, $victim));
    }

    private function getDamage(float $damage, Entity $victim): float{
        $difLevel =  $victim->getLevel() - $this->getLevel();
        $p = 1;
        
        if($difLevel>=5)    
            $p=0.5;
        if($difLevel<=-5)
            $p=1.5;
        
        return $damage*$p;
    }

    public function heal(float $health, Character $healed): void
    {
        if(!$this->rules->canHeal($health,$healed))
            return;
        
        if($healed->getHealth() + $health < 1000){
            $this->takeHealth($health);
            $healed->giveHealth($health);
            return;
        } 

        $this->takeHealth(1000-$healed->getHealth());
        $healed->setHealth(1000);        
    }
    
    public function isNearRange(Entity $character): bool
    {
        return Point::areNearRange($this->position, $character->position, $this->getRange());
    }
   
    public function getRange(): float
    {
        return $this->type->getRange();
    }

    public function addFaction(int $i): void
    {
        $this->factions->addFaction($i);
    }

    public function leaveFaction(int $i): void
    {
        $this->factions->leaveFaction($i);
    }
    
    public function getFactions(): array
    {   
        return $this->factions->All();
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    public function getType(): Type
    {
        return $this->type;
    }
    
    public function setMaxAttack(int $maxAttack): void 
    {
        $this->maxAttack = $maxAttack;
    }

    public function getMaxAttack(): float
    {
        return $this->maxAttack;
    }

    public function takeHealth(float $damage): void
    {
        $this->health-=$damage;
    }
}

