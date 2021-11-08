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
}
