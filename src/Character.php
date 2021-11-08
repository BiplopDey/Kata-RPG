<?php

namespace App;

class Character
{
    private int $health = 1000;
    private int $level = 1;
    private bool $alive = true;

    public function hit(int $damage, Character $victim){
        $victim<-setHealth()
    }

    public function setHealth(){
        
    }

    public function getHealth(): int{
        return $this->health;
    }
    public function getLevel(): int{
        return $this->level;
    }
    public function isAlive(): bool{
        return $this->alive;
    }
}
