<?php

namespace App;
use App\Fighter\Type;
use App\Fighter\Melee;
use App\Geometry\Point;
use App\Faction\Factions;
use App\Rules\Rules;

abstract class Entity
{
    protected float $health;
    protected int $level;
    protected bool $alive = true;
    protected Point $position;
    protected float $range;

    public function __construct(float $health, int $level, Point $position) 
    {
        $this->health = $health;
        $this->level = $level; 
        $this->position = $position;
    }

    public abstract function isNearRange(Character $character): bool;
    public abstract function takeHealth(float $damage): void;

    public function getRange(): float
    {
        return $this->range;
    }

    public function setPosition(Point $p): void
    {
        $this->position = $p;
    }

    public function getPosition(): Point
    {
        return $this->position;
    }
    
    protected function checkAlive(): void
    {
        $this->alive = $this->health > 0;
    }
    
    protected function giveHealth(float $health): void
    {
        $this->health+=$health;
    }

    public function setHealth(float $health): void 
    {//make protected after testing
        $this->health=$health;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function isAlive(): bool
    {
        $this->checkAlive();
        return $this->alive;
    }
}

