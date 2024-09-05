<?php

/**
 * Conversion from Roman numeral to decimal
 * 
 * @author  Arturo Mora-Rioja
 * @version 1.0.0 January 2023
 * @version 1.1.0 September 2024. Specification checks added
 */

function roman2decimal(string $number): int {

    // Invalid symbols are removed from the string
    $number = str_split($number);
    $cleanNumber = [];
    foreach ($number as $letter) {
        if (in_array($letter, ['M', 'D', 'C', 'L', 'X', 'V', 'I'])) {
            $cleanNumber[] = $letter;
        }
    }
    $number = implode($cleanNumber);

    // V, L and D can never be repeated
    if (substr_count($number, 'V') > 1 || 
        substr_count($number, 'L') > 1 || 
        substr_count($number, 'D') > 1) {
            throw new Exception('Badly formed Roman numeral');
    }

    // No digit can be repeated more than 3 times in a row
    if (str_contains($number, 'MMMM') ||
        str_contains($number, 'CCCC') ||
        str_contains($number, 'XXXX') ||
        str_contains($number, 'IIII')) {
            throw new Exception('Badly formed Roman numeral');
    }

    // D cannot precede M
    if (str_contains($number, 'DM')) {
        throw new Exception('Badly formed Roman numeral');
    }

    // L cannot precede M, D or C
    if (str_contains($number, 'LM') ||
        str_contains($number, 'LD') ||
        str_contains($number, 'LC')) {
            throw new Exception('Badly formed Roman numeral');
    }

    // V cannot precede M, D, C, L or X
    if (str_contains($number, 'VM') ||
        str_contains($number, 'VD') ||
        str_contains($number, 'VC') ||
        str_contains($number, 'VL') ||
        str_contains($number, 'VX')) {
            throw new Exception('Badly formed Roman numeral');
    }

    // X cannot precede D
    if (str_contains($number, 'XD')) {
            throw new Exception('Badly formed Roman numeral');
    }

    // I cannot precede M, D, C, L
    if (str_contains($number, 'IM') ||
        str_contains($number, 'ID') ||
        str_contains($number, 'IC') ||
        str_contains($number, 'IL')) {
            throw new Exception('Badly formed Roman numeral');
    }

    // Each letter of the Roman numeral is translated into its decimal value
    $digits = [];
    foreach ($cleanNumber as $letter) {
        switch($letter) {
            case 'M': $digits[] = 1000; break;
            case 'D': $digits[] = 500; break;
            case 'C': $digits[] = 100; break;
            case 'L': $digits[] = 50; break;
            case 'X': $digits[] = 10; break;
            case 'V': $digits[] = 5; break;
            case 'I': $digits[] = 1; break;
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