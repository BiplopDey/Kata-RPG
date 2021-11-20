<?php

namespace App;
use App\Fighter\Type;
use App\Fighter\Melee;
use App\Geometry\Point;
use App\Faction\Factions;
use App\Rules\Rules;

class Character
{
    private float $health = 1000;
    private int $level = 1;
    private bool $alive = true;
    private int $maxAttack;
    private Type $type;
    private Point $position;
    private Factions $factions;
    private Rules $rules;

    public function __construct() {
        $this->rules = new Rules($this);
        $this->position = new Point(0,0);
        $this->type = new Melee();
        $this->factions = new Factions();
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

    public function isNearRange(Character $character): bool
    {
        return Point::twoPointsNear($this->position, $character->position, $this->type->getRange());
    }
    public function addFaction(int $i)
    {
        $this->factions->addFaction($i);
    }
    public function leaveFaction(int $i)
    {
        $this->factions->leaveFaction($i);
    }
    public function setPosition(Point $p)
    {
        $this->position = $p;
    }
    public function getFactions()
    {   
        return $this->factions->All();
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
    public function setRange(int $range): void {
        $this->range = $range;
    }
    public function setMaxAttack(int $maxAttack): void {
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
    public function setHealth($health){//make private after testing
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

