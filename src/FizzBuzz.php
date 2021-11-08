<?php

namespace App;

class FizzBuzz {
    public function execute($num){
        if($num % 3 ===0 && $num % 5 ===0 ) return 'fizzBuzz';
        if($num % 3 ===0) return 'fizz';
        if($num % 5 ===0) return 'Buzz';
        return $num;
    }
}
