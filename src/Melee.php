<?php

namespace App;
use App\Type;

class Melee extends Type{
    function __construct( string $name, int $range)
    {
        parent::__construct($name, $range);
    }
}