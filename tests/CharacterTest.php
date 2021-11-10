<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Character;


class CharacterTest extends TestCase
{
    public function test_Health_starting_at_1000(){
        $fighter = new Character();
        $result = $fighter->getHealth();
        $this->assertEquals(1000, $result);
    }

    public function test_Level_starting_at_1(){
        $fighter = new Character();
        $result = $fighter->getLevel();
        $this->assertEquals(1, $result);
    }

    public function test_starting_alive(){
        $fighter = new Character();
        $result = $fighter->isAlive();
        $this->assertTrue($result);
    }

    public function test_character_can_damage_and_substract_from_health(){
        $attaker = new Character();
        $damaged = new Character();

        $attaker->hit(100, $damaged);

        $this->assertEquals(900, $damaged->getHealth());
    }

    public function test_kill_character(){
        $attaker = new Character();
        $damaged = new Character();
        
        $attaker->hit(1100, $damaged);

        $this->assertFalse($damaged->isAlive());
    }

    public function test_dead_characters_cannot_be_healed(){
        $attaker = new Character();
        $damaged = new Character();
        $healer = new Character();
        
        $attaker->hit(1100, $damaged);
        $healer->heal(100, $damaged);

        $this->assertFalse($damaged->isAlive());
    }
    
    public function test_healing_cannot_raise_health_above_1000(){
        $attaker = new Character();
        $healed = new Character();
        $healer = new Character();
        
        $attaker->hit(200, $healed);
        $healer->heal(300, $healed);

        $this->assertEquals(1000,$healed->getHealth());
        $this->assertEquals(800,$healer->getHealth());
        
    }
    public function test_a_character_cannot_deal_damage_to_itself(){
        $character = new Character();
        $character->hit(200, $character);
        $this->assertEquals(1000,$character->getHealth());

    }

    public function test_a_character_can_only_heal_itself(){
        $attaker = new Character();
        $character = new Character();
       
        $attaker->hit(200, $character);
        $character->heal(300, $character);

        $this->assertEquals(800,$character->getHealth());
       
    }
     public function test_damage_is_reduced_by_50(){
        //If the target is 5 or more Levels above the attacker, Damage is reduced by 50%
        $attaker = new Character();
        $damaged = new Character();
        $damaged->setLevel(10);
        $attaker->hit(100, $damaged);

        $this->assertEquals(950, $damaged->getHealth());
     }
}
