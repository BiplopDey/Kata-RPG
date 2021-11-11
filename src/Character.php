<?php

namespace App;
use App\Type;
use App\Melee;
use App\Ranged;
use App\Point;
use App\Factions;
use App\EnumFaction;
class Character
{
    private int $health = 1000;
    private int $level = 1;
    private bool $alive = true;
    private int $maxAttack;
    private Type $type;
    private Point $position;
    private Factions $factions;

    public function __construct() {
        $this->position = new Point(0,0);
        $this->type = new Melee();
        $this->factions = new Factions();
    }

    public function hit(int $damage, Character $victim){
        if($this !== $victim && $this->isNearRange($victim)){
            $difLevel =  $victim->getLevel()-$this->getLevel();
            $p = 1;
            if($difLevel>=5)    
            $p=0.5;
            elseif($difLevel<=-5)
            $p=1.5;
            
            $victim->takeHealth($damage*$p);
        }
    }

    public function heal($health, $healed){
        if($healed->isAlive() && $this->getHealth()>$health && $this !== $healed && $this->isNearRange($healed)){ 
            // healed must be alive and the healer cannot give more heath than he has
            if($healed->getHealth()+$health < 1000){
                $this->takeHealth($health);
                $healed->giveHealth($health);
            } else {
                $this->takeHealth(1000-$healed->getHealth());
                $healed->setHealth(1000);
            }
        }
    }

    public function isNearRange(Character $character): bool
    {
        return Point::distance($this->position, $character->position) <= $this->type->getRange();
    }
    
    public function addFactions(int $i)
    {
        $this->factions->addFactions($i);
    }

    public function setPosition(Point $p)
    {
        $this->position = $p;
    }

    public function getFactions(): Factions
    {   
        return $this->factions;
    }
    public function getPosition(): Point{
        return $this->position;
    }

    public function setType(Type $type){
        $this->type = $type;
    }

    public function getType(): Type {
        return $this->type;
    }

    public function setRange(int $range){
        $this->range = $range;
    }

    public function setMaxAttack(int $maxAttack){
        $this->maxAttack = $maxAttack;
    }
    public function getMaxAttack(): int{
        return $this->maxAttack;
    }

    private function checkAlive(){
        $this->alive = $this->health > 0;
    }

    private function takeHealth($damage){
        $this->health-=$damage;
    }

    private function giveHealth($health){
        $this->health+=$health;
    }

    private function setHealth($health){
        $this->health=$health;
    }

    public function getHealth(): int{
        return $this->health;
    }

    public function getLevel(): int{
        return $this->level;
    }

    public function setLevel(int $level){
        $this->level = $level;
    }

    public function isAlive(): bool{
        $this->checkAlive();
        return $this->alive;
    }
}
