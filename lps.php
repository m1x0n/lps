<?php

use Utilities\String\LongestPalindromicSubstringFinder;

require dirname(__FILE__) . '/vendor/autoload.php';

$utility = new LongestPalindromicSubstringFinder("детство");
echo $utility->find() . PHP_EOL;