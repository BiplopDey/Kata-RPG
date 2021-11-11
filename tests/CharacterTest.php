<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Character;
use App\EnumFaction;
use App\Type;
use App\Melee;
use App\Ranged;
use App\Point;
use App\EnumFactions;

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

     public function test_damage_is_increased_by_50(){
        //If the target is 5 or more levels below the attacker, Damage is increased by 50%
        $attaker = new Character();
        $damaged = new Character();
        $attaker->setLevel(10);
        $attaker->hit(100, $damaged);

        $this->assertEquals(850, $damaged->getHealth());
     }

     public function test_set_maxAttack(){
        $character = new Character();
        $character->setMaxAttack(200);
        $this->assertEquals(200,$character->getMaxAttack());
     }

     public function test_Melee_and_Ranged(){
        $melee = new Character();
        $ranged = new Character();
        $melee->setType( new Melee());
        $ranged->setType(new Ranged());
        $this->assertEquals("Melee",$melee->getType()->getName());
        $this->assertEquals("Melee",$melee->getType()->getName());
     }

     public function test_nearRange()
     {
        $melee = new Character();
        $ranged = new Character();

        $melee->setType( new Melee());
        $ranged->setType(new Ranged() );
        
        $melee->setPosition( new Point(0, 1));
        $ranged->setPosition( new Point(0, 5));
        
        $melee->hit(200,$ranged);
        $this->assertEquals(1000,$ranged->getHealth());

        $ranged->hit(200,$melee);
        $this->assertNotEquals(1000,$melee->getHealth());
     }

     public function test_characters_may_belong_to_one_or_more_Factions()
     {
        $character = new Character();
        $character->addFactions(EnumFaction::Faction2);
        $this->assertEquals(EnumFaction::Faction2, $character->getFactions()->All()[0]);

        $character->addFactions(EnumFaction::Faction3);
        $this->assertEquals(EnumFaction::Faction3, $character->getFactions()->All()[1]);

     }
}
