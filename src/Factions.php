<?php

namespace App;
use App\Character;
use Ds\Set;

class Factions{
    private  $list= array();

    public function addFaction(int $i): void
    {
        $this->list[$i]=$i;
       
    }
    public function leaveFaction(int $i): void
    {
        unset($this->list[$i]);
        //$this->list = array_diff($this->list,array($i));
       
    }

    public function All(){
        return $this->list;
    }

}