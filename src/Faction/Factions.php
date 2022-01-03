<?php

namespace App\Faction;


class Factions{
    
    private array $list = array();
    public function addFaction(int $i): void
    {
        $this->list[$i]=$i;
    }
    public function leaveFaction(int $i): void
    {
        unset($this->list[$i]);
    }

    public function All(): array
    {
        return $this->list;
    }

}