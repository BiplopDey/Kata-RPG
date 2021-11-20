<?php

namespace App\Fighter;
use App\Fighter\Type;

class Ranged extends Type{
    function __construct()
    {
        parent::__construct("Ranged",20);
    }
}