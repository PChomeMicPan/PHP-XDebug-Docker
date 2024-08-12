<?php

namespace Tests\Unit\Classes;

use Classes\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{

    public function test_sum()
    {
        $math = new Math();
        $this->assertSame($math->sum(1, 2), 3);
    }
}
