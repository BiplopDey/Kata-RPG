<?php

namespace App;
use App\Character;

class Factions{
    private $list=array();

    public function addFactions(int $i): void
    {
        array_push($this->list, $i);
    }

    public function All(): array
    {
        return $this->list;
    }

}