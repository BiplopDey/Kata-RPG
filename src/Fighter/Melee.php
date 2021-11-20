<?php

namespace App\Fighter;
use App\Fighter\Type;

class Melee extends Type{
    function __construct()
    {
        parent::__construct("Melee",2);
    }
}