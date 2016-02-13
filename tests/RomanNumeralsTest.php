<?php

namespace Komakino\RomanNumerals\Tests;

use Komakino\RomanNumerals\RomanNumerals as Roman;

class RomanNumeralsTest extends \PHPUnit_Framework_TestCase
{

    private $testValues = [
        'MMMDCCLXXXV'  => 3785,
        'MMXVI'        => 2016,
        'M'            => 1000,
        'CMXCIX'       => 999,
        'DCLXVI'       => 666,
        'D'            => 500,
        'C'            => 100,
        'XCIX'         => 99,
        'LXXV'         => 75,
        'LII'          => 52,
        'L'            => 50,
        'XLII'         => 42,
        'XIV'          => 14,
        'X'            => 10,
        'IX'           => 9,
        'VIII'         => 8,
        'VII'          => 7,
        'VI'           => 6,
        'V'            => 5,
        'IV'           => 4,
        'III'          => 3,
        'II'           => 2,
        'I'            => 1,
        'nulla'        => 0,
    ];

    private $roman  = [];
    private $arabic = [];

    public function setUp() {
        $this->roman  = array_keys($this->testValues);
        $this->arabic = array_values($this->testValues);
    }

    public function testValidation()
    {
        $this->assertTrue(Roman::validateRomanString("MMXIV"), "Failed to validate MMXIV as true");
        $this->assertFalse(Roman::validateRomanString("MMXY"), "Failed to validate MMXY as false");

    }

    public function testToRoman()
    {
        foreach ($this->arabic as $i => $value) {
            $this->assertSame($this->roman[$i], Roman::to($value), "Failed converting {$value} to {$this->roman[$i]}");
        }
    }

    public function testFromRoman()
    {
        foreach ($this->roman as $i => $value) {
            $this->assertSame($this->arabic[$i], Roman::from($value), "Failed converting {$value} to {$this->arabic[$i]}");
        }
    }

    public function testIllegalCharacterException()
    {
        $this->setExpectedException('InvalidArgumentException','Input contains illegal characters');
        Roman::from("XXB");
    }

    public function testNegativeNumberException()
    {
        $this->setExpectedException('OutOfBoundsException','Cannot convert negative numbers');
        Roman::to(-5);
    }

    public function testTooLargeNumberException()
    {
        $this->setExpectedException('OutOfBoundsException','Cannot convert numbers over 3999');
        Roman::to(4567);
    }
}
