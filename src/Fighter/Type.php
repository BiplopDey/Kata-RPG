<?php

namespace App\Fighter;

abstract class Type{
    protected float $range;
    protected string $name;
    
    function __construct(string $name, int $range)
    {
        $this->name=$name;
        $this->range=$range;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getRange(): float
    {
        return $this->range;
    }
}