<?php

namespace App;

abstract class Type{
    protected int $range;
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
    public function getRange(): string
    {
        return $this->range;
    }
}