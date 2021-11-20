<?php

namespace App\Faction;
use App\Character;

class Factions{
    
    private  $list= array();
    public function addFaction(int $i): void
    {
        $this->list[$i]=$i;
    }
    public function leaveFaction(int $i): void
    {
        unset($this->list[$i]);
    }

    public function All(){
        return $this->list;
    }

}