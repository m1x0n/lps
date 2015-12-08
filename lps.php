<?php

use Utilities\String\LongestPalindromicSubstringFinder;

require dirname(__FILE__) . '/vendor/autoload.php';

$testStrings = [
    "детство",
    "madam Bowery",
    "Аргентина манит негра",
    "Xanax",
    "радар",
    "Yo banana boy",
    "b",
    "palindrome"
];

foreach($testStrings as $test) {
    echo (new LongestPalindromicSubstringFinder($test))->find() . PHP_EOL;
}