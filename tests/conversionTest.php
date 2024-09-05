<?php

require_once 'src/conversion.php';

use PHPUnit\Framework\TestCase;

class conversionTest extends TestCase {

    /**
     * @dataProvider provide_roman_to_decimal
     */
    public function test_roman_to_decimal_passes($value, $expected): void {
        $result = roman2decimal($value);

        $this->assertEquals($expected, $result);
    }
    public function provide_roman_to_decimal() {
        return [
            ['', 0],                // Valid lower boundary
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
            ['MMMCMXCIX', 3999],    // Valid upper boundary
        ];
    }
    
    /**
     * @dataProvider provide_badly_formed_roman_numerals
     */
    public function test_badly_formed_roman_numerals($value): void {
        $this->expectExceptionMessage('Badly formed');
        $result = roman2decimal($value);
    }
    public function provide_badly_formed_roman_numerals() {
        return [
            ['MXDIVII', false],
            ['VV', false],
            ['MDVVI', false],
            ['MDVXVI', false],
            ['LL', false],
            ['MDLLX', false],
            ['MDLXLV', false],
            ['DD', false],
            ['MDDCX', false],
            ['MDCDXVI', false],
            ['IIII', false],
            ['XVIIII', false],
            ['CLIIIIX', false],
            ['XXXX', false],
            ['MDXXXX', false],
            ['MCXXXXV', false],
            ['CCCC', false],
            ['MDCCCC', false],
            ['MCCCCDV', false],
            ['MMMM', false],        // Invalid upper boundary
            ['MMMMCL', false],
            ['DM', false],
            ['LM', false],
            ['LD', false],
            ['LC', false],
            ['VM', false],
            ['VD', false],
            ['VC', false],
            ['VL', false],
            ['VX', false],
            ['XD', false],
            ['IM', false],
            ['ID', false],
            ['IC', false],
            ['IL', false],
        ];
    }
}