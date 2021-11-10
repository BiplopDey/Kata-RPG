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

    private function takeHealth(int $health){
        $this->health-=$health;
    }

    private function giveHealth(int $health){
        $this->health+=$health;
    }

    private function setHealth(int $health){
        $this->health=$health;
    }

    private function checkLive(){
        $this->alive = $this->getHealth() > 0;
    }

    public function heal(int $health, Character $healed){
        if($healed->isAlive()){
            if(($healed->getHealth()+$health)<=1000){
                $this->takeHealth($health);
                $healed->giveHealth($health);
            } else{
                $healed->setHealth(1000);
                $this->takeHealth(1000-$health);
            }
        }
    }

    public function getHealth(): int{
        return $this->health;
    }
    public function getLevel(): int{
        return $this->level;
    }
    public function isAlive(): bool{
        $this->checkLive();
        return $this->alive;
    }
}

$attaker = new Character();
        $damaged = new Character();

        $attaker->hit(100, $damaged);