<?php

namespace App;

class Character
{
    private int $health = 1000;
    private int $level = 1;
    private bool $alive = true;

    public function hit(int $damage, Character $victim){
        $victim->takeHealth($damage);
    }

    private function checkAlive(){
        $this->alive = $this->health > 0;
    }

    private function takeHealth($damage){
        $this->health-=$damage;
    }

    private function giveHealth($health){
        $this->health-=$health;
    }

    public function heal($health, $healed){
        if($healed->isAlive()){
            $healed->giveHealth($health);
        }
    }

    public function getHealth(): int{
        return $this->health;
    }
    public function getLevel(): int{
        return $this->level;
    }
    public function isAlive(): bool{
        $this->checkAlive();
        return $this->alive;
    }
}
