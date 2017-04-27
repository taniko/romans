<?php
namespace Test;

use Taniko\Romans\Parser;

class ParserTest extends \PHPUnit\Framework\TestCase
{
    public function testToInt()
    {
        $this->assertEquals(1, Parser::toInt('I'));
        $this->assertEquals(1, Parser::toInt('Ⅰ'));
        $this->assertEquals(10, Parser::toInt('X'));
        $this->assertEquals(10, Parser::toInt('Ⅹ'));
        $this->assertEquals(2017, Parser::toInt('MMXVII'));
        $this->assertEquals(2017, Parser::toInt('MMⅩVII'));
    }

    public function testToRoman()
    {
        $this->assertEquals('I', Parser::toRoman(1));
        $this->assertEquals('III', Parser::toRoman(3));
        $this->assertEquals('MMXVII', Parser::toRoman(2017));
    }

    public function testReplaceRoman()
    {
        $this->assertEquals('I', Parser::replaceRoman('Ⅰ'));
        $this->assertEquals('X', Parser::replaceRoman('Ⅹ'));
    }
}
