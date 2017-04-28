<?php
namespace Test;

use Taniko\Romans\Roman;

class RomanTest extends \PHPUnit\Framework\TestCase
{
    public function testIsRoman()
    {
        $this->assertTrue(Roman::isRoman('I'));
        $this->assertTrue(Roman::isRoman('MMXVII'));
        $this->assertTrue(Roman::isRoman('ⅿmⅩvii'));
        $this->assertTrue(Roman::isRoman('Ⅰ'));
        $this->assertTrue(Roman::isRoman('ⅿ'));
        $this->assertFalse(Roman::isRoman('QWERTY'));
        $this->assertFalse(Roman::isRoman('XVIIM'));
    }
}
