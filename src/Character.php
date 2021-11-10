<?php

namespace App;

class Character
{
    private int $health = 1000;
    private int $level = 1;
    private bool $alive = true;

    public function hit(int $damage, Character $victim){
        if($this !== $victim)
        $victim->takeHealth($damage);
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

    public function heal($health, $healed){
        if($healed->isAlive() && $this->getHealth()>$health && $this !== $healed){ 
            // healed is alive and the healer cannot give more heath than he has
            if($healed->getHealth()+$health < 1000){
                $this->takeHealth($health);
                $healed->giveHealth($health);
            } else {
                $this->takeHealth(1000-$healed->getHealth());
                $healed->setHealth(1000);
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
        $this->checkAlive();
        return $this->alive;
    }
}
