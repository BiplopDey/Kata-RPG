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

    public function __construct() {
        parent::__construct(1000,1, new Point(0,0));
        $this->factions = new Factions();
        $this->type = new Melee();
        $this->rules = new Rules($this);
    }

    public function hit(float $damage, Character $victim){
        if($this->rules->canHit($victim)){
            $difLevel =  $victim->getLevel()-$this->getLevel();
            $p = 1;
            if($difLevel>=5)    
            $p=0.5;
            elseif($difLevel<=-5)
            $p=1.5;
            
            $victim->takeHealth($damage*$p);
        }
    }

    public function heal(float $health,Character $healed){
        if($this->rules->canHeal($health,$healed)){
            if($healed->getHealth()+$health < 1000){
                $this->takeHealth($health);
                $healed->giveHealth($health);
            } else {
                $this->takeHealth(1000-$healed->getHealth());
                $healed->setHealth(1000);
            }
        }
    }
    
    
    public function addFaction(int $i)
    {
        $this->factions->addFaction($i);
    }
    public function leaveFaction(int $i)
    {
        $this->factions->leaveFaction($i);
    }
    
    public function getFactions()
    {   
        return $this->factions->All();
    }

    public function setType(Type $type){
        $this->type = $type;
    }
    public function getType(): Type {
        return $this->type;
    }
    

    public function setMaxAttack(int $maxAttack): void {
        $this->maxAttack = $maxAttack;
    }
    public function getMaxAttack(): float{
        return $this->maxAttack;
    }
}

