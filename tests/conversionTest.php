<?php

require_once 'src/conversion.php';

use PHPUnit\Framework\TestCase;

class conversionTest extends TestCase {

    /**
     * @dataProvider provideRoman2Decimal
     */
    public function testRoman2DecimalConversion($value, $expected): void {
        $result = roman2decimal($value);

        $this->assertEquals($expected, $result);
    }
    public function provideRoman2Decimal() {
        return [
            ['', 0],            
            ['M', 1000],            
            ['MD', 1500],            
            ['MCD', 1400],
            ['MDCCCLXVII', 1867],
            ['XCIV', 94],
            ['CCC', 300],
            ['I', 1],
            ['X', 10],
            ['IX', 9],
            ['MMXXIII', 2023],
            ['MMJXXOIII', 2023],
            ['MXDIVII', 1496],
        ];
    }

}