<?php

use Utilities\String\LongestPalindromicSubstringFinder;

class LongestPalindromicSubstringFinderTest extends PHPUnit_Framework_TestCase {

    public function testConfirmWorldExists()
    {
        $this->assertEquals(1, 1);
    }

    /**
     * @param $testString
     * @dataProvider invalidArgumentDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testInvalidArgumentProvided($testString)
    {
        $utility = new LongestPalindromicSubstringFinder($testString);
    }

    /**
     * @expectedException LengthException
     */
    public function testEmptyStringProvided()
    {
        $utility = new LongestPalindromicSubstringFinder("");
    }

    /**
     * @param $testString
     * @param $expected
     * @dataProvider selfPalindromeWordsDataProvider
     */
    public function testWordIsAPalindromeItself($testString, $expected)
    {
        $utility = new LongestPalindromicSubstringFinder($testString);
        $longest = $utility->find();

        $this->assertEquals($expected, $longest);
    }

    /**
     * @param $testString
     * @param $expected
     * @dataProvider selfPalindromeSentencesDataProvider
     */
    public function testSentenceIsAPalindromeItself($testString, $expected)
    {
        $utility = new LongestPalindromicSubstringFinder($testString);
        $longest = $utility->find();

        $this->assertEquals($expected, $longest);
    }

    public function testOnCharacterStringShouldBeTheLongestPalindrome()
    {
        $utility = new LongestPalindromicSubstringFinder("a");
        $longest = $utility->find();

        $this->assertEquals("a", $longest);
    }

    /**
     * @param $testString
     * @param $expected
     * @dataProvider nonPalindromesDataProvider
     */
    public function testOnNonPalindromicWords($testString, $expected)
    {
        $utility = new LongestPalindromicSubstringFinder($testString);
        $longest = $utility->find();

        $this->assertEquals($expected, $longest);
    }


    /**
     * @param $testString
     * @param $expected
     * @dataProvider palindromicSubstringDataProvider
     */
    public function testOnLongestPalindromeSubstringInNonePalindromeString($testString, $expected)
    {
        $utility = new LongestPalindromicSubstringFinder($testString);
        $longest = $utility->find();

        $this->assertEquals($expected, $longest);
    }

    /**
     * @return array
     */
    public function invalidArgumentDataProvider()
    {
        return [
            [1],
            [null],
            [true],
            [new stdClass()]
        ];
    }

    /**
     * @return array
     */
    public function selfPalindromeWordsDataProvider()
    {
        return [
            ["bob", "bob"],
            ["php", "php"],
            ["rotator", "rotator"],
            ["madam", "madam"],
            ["Xanax", "xanax"],
            ["stats", "stats"],
            ["Racecar", "racecar"],
            ["потоп", "потоп"],
            ["шалаш", "шалаш"],
            ["кабак", "кабак"],
            ["радар", "радар"],
            ["ушу", "ушу"],
            ["казак", "казак"]
        ];
    }

    /**
     * @return array
     */
    public function selfPalindromeSentencesDataProvider()
    {
        return [
            ["Live evil", "liveevil"],
            ["Yo banana boy", "yobananaboy"],
            ["Ten animals I slam in a net", "tenanimalsislaminanet"],
            ["Dennis and Edna sinned", "dennisandednasinned"],
            ["а роза упала на лапу Азора", "арозаупаланалапуазора"],
            ["Аргентина манит негра", "аргентинаманитнегра"],
            ["И леопард и гидра поели", "илеопардигидрапоели"],
            ["Пил вино он и влип", "пилвиноонивлип"],
            ["Нажал кабан на баклажан", "нажалкабаннабаклажан"]
        ];
    }

    /**
     * @return array
     */
    public function nonPalindromesDataProvider()
    {
        return [
            ["random", "r"],
            ["test", "t"],
            ["palindrome", "p"],
            ["пингвин", "п"],
            ["рефрежиратор", "р"],
            ["Калина красная", "к"]
        ];
    }

    /**
     * @return array
     */
    public function palindromicSubstringDataProvider()
    {
        return [
            ["Bob loves Mary", "bob"],
            ["Madam Bowery knew a lot.", "madam"],
            ["Madam has a racecar", "racecar"],
            ["Туристы построили шалаш.", "шалаш"],
            ["детство", "тст"],
            ["Термин ушу есть ни что иное как боевые искусства", "ушу"]
        ];
    }
}