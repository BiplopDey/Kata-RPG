<?php

namespace App;
use App\Type;

class Melee extends Type{
    function __construct()
    {
        parent::__construct("Melee",2);
    }
}