<?php

namespace App;
use App\Fighter\Type;
use App\Fighter\Melee;
use App\Geometry\Point;
use App\Faction\Factions;
use App\Rules\Rules;

abstract class Entity
{
    private float $health;
    private int $level;
    private bool $alive = true;
    private Point $position;

    public function __construct(float $health, int $level, Point $position) {
        $this->health = $health;
        $this->level = $level; 
        $this->position = $position;
        
    }

    public function isNearRange(Character $character): bool
    {
        return Point::twoPointsNear($this->position, $character->position, $this->type->getRange());
    }
    public function setPosition(Point $p)
    {
        $this->position = $p;
    }
    public function getPosition(): Point{
        return $this->position;
    }
    public function setRange(int $range): void {
        $this->range = $range;
    }
    
    protected function checkAlive(){
        $this->alive = $this->health > 0;
    }
    protected function takeHealth($damage){
        $this->health-=$damage;
    }
    protected function giveHealth($health){
        $this->health+=$health;
    }
    public function setHealth($health){//make protected after testing
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

