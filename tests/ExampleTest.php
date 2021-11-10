<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use App\FizzBuzz;

class FizzBuzzTest extends TestCase {

    public function test_returns_fizzBuzz_if_is_multiple_of_3_and_5 () {
        $fizzBuzz = new FizzBuzz ();
        $result = $fizzBuzz->execute (15);
        $this -> assertEquals("fizzBuzz",$result);
    }
    public function test_returns_fizz_if_is_multiple_of_3 () {
        $fizzBuzz = new FizzBuzz ();
        $result = $fizzBuzz->execute (9);
        $this -> assertEquals("fizz",$result);
    }

    public function test_returns_fizz_if_is_multiple_of_5 () {
        $fizzBuzz = new FizzBuzz ();
        $result = $fizzBuzz->execute (10);
        $this -> assertEquals("Buzz",$result);
    }
    public function test_returns_number_if_is_not_multiple_of_3_and_5 () {
        $fizzBuzz = new FizzBuzz ();
        $result = $fizzBuzz->execute (7);
        $this -> assertEquals(7,$result);
    }

	public function test_list(){
		$listNum = array(1,2,3,4,5);
		$listResult = array(1,2,"fizz",4,"Buzz");
		$fizzBuzz = new FizzBuzz ();
		for($i=0;$i<5;$i++){
			$result = $fizzBuzz->execute ($listNum[$i]);
			$this -> assertEquals($listResult[$i],$result);
		}
	}
}


