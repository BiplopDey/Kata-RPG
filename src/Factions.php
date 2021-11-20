<?php

namespace App;
use App\Character;
use Ds\Set;

class Factions{
    //private Set $list= new Set();
    $list = new \Ds\Set();
    public function addFaction(int $i): void
    {
        //array_push($this->list, $i);
        $this->list->add($i);
    }
    public function leaveFaction(int $i): void
    {
        //unset($this->list[array_search($i,$this->list)]);
        //$this->list = array_diff($this->list,array($i));
        $this->list->remove($i);
    }

    public function All(){
        return $this->list;
    }

}