<?php

namespace App;
use App\Fighter\Type;
use App\Fighter\Melee;
use App\Geometry\Point;
use App\Faction\Factions;
use App\Rules\Rules;
use App\Entity;
class Things extends Entity
{
    
    public function __construct() {
        parent::__construct(1000,1, new Point(0,0));
        $this->range = 2;
    }
    
    public function isNearRange(Entity $character): bool{
        return Point::twoPointsNear($this->position, $character->position, $this->range);
    }
   
    
    public function takeHealth($damage): void{
        $this->health-=$damage;
        if(!$this->isAlive())
        $this->destroy();
    }

    public function destroy(): void{
        //destroy
    }
}