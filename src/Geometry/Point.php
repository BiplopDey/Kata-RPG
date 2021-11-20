<?php

namespace App\Geometry;

class Point {
    public int $x;
    public int $y;
    public function __construct(int $x, int $y) {
        $this-> x= $x;
        $this-> y= $y;
    }

    public static function distance(Point $a, Point $b): float
    {
       return sqrt(($a->x-$b->y)**2+($a->y-$b->y)**2);
    }

    public static function twoPointsNear(Point $a, Point $b, int $range): bool
    {
        return self::distance($a, $b) <= $range;
    }
}