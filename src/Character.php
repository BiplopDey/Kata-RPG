<?php

namespace App;

class Character
{
    private int $health = 1000;
    private int $level = 1;
    private bool $alive = true;
    private int $maxAttack;

    public function hit(int $damage, Character $victim){
        if($this !== $victim){
            $diff =  $victim->getLevel()-$this->getLevel();
            $p = 1;
            if($diff>=5)    
            $p=0.5;
            elseif($diff<=-5)
            $p=1.5;
            
            $victim->takeHealth($damage*$p);
        }
        
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
    public function setLevel(int $level){
        $this->level = $level;
    }
    public function isAlive(): bool{
        $this->checkAlive();
        return $this->alive;
    }
}
