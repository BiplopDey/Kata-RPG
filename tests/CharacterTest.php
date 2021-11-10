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

    public function test_character_dead(){
        $attaker = new Character();
        $damaged = new Character();

        $attaker->hit(1100, $damaged);

        $this->assertFalse($damaged->isAlive());
    }

    public function test_not_heal_dead_character(){
        $attaker = new Character();
        $healer = new Character();
        $healed = new Character();
        $attaker->hit(1100, $healed);
        
        $healer->heal(200,$healed);
        $this->assertFalse($healed->isAlive());
    }

    public function test_healing_cannot_raise_health_above_1000(){
        $attaker = new Character();
        $healer = new Character();
        $healed = new Character();
        $attaker->hit(100, $healed);
        
        $healer->heal(2000,$healed);
        $this->assertEquals(1000,$healed->getHealth());
    }
    public function a_character_cannot_deal_damage_to_itself(){
        $character = new Character();
        $character->hit(200,$character);
        $this->assertEquals(9000,2);
    }
}
