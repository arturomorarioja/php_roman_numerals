<?php

/**
 * Conversion from Roman numeral to decimal
 * 
 * @author  Arturo Mora-Rioja
 * @version 1.0.0 January 2023
 */

function roman2decimal(string $number): int {

    // Each letter of the Roman numeral is translated into its decimal value
    $number = str_split($number);
    $digits = [];
    foreach ($number as $letter) {
        switch($letter) {
            case 'M': $digits[] = 1000; break;
            case 'D': $digits[] = 500; break;
            case 'C': $digits[] = 100; break;
            case 'L': $digits[] = 50; break;
            case 'X': $digits[] = 10; break;
            case 'V': $digits[] = 5; break;
            case 'I': $digits[] = 1; break;
            default: break; // Incorrect letters are simply ignored
        }
    }

    // Each value is added (if preceding a smaller or equal one) or subtracted (if preceded by a larger one)
    $number = 0;
    $size = count($digits);
    for ($index = 0; $index < $size; $index++) {
        if ($size === $index + 1) {
            $number += $digits[$index];
        } else if ($digits[$index] < $digits[$index + 1]) {
            $number -= $digits[$index];
        } else {
            $number += $digits[$index];
        }
    }

    return $number;
}

