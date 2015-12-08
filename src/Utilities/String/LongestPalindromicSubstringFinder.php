<?php

namespace Utilities\String;

/**
 * Class LongestPalindromicSubstringFinder
 * Provides Manacher's algorithm implementation with multi-byte strings support
 *
 * @package Utilities\String
 */
class LongestPalindromicSubstringFinder {
    /**
     * @var string $originalString
     */
    private $originalString;

    /**
     * @var string $cleanedString
     */
    private $cleanedString;

    /**
     * @var string $formattedString
     */
    private $formattedString;

    /**
     * @var array $lengthTracker
     */
    private $lengthTracker = [];

    /**
     * LongestPalindromicSubstringFinder constructor.
     *
     * @param string $s
     */
    public function __construct($s)
    {
        if (!is_string($s)) {
            throw new \InvalidArgumentException("Invalid argument provided. Expected string got " . gettype($s));
        }

        if (!strlen($s)) {
            throw new \LengthException("Empty string provided");
        }

        $this->originalString = $s;
    }

    /**
     * Manacher's algorithm implementation attempt
     * @return string
     */
    public function find()
    {
        return $this->cleanString()
            ->formatString()
            ->calculateLengths()
            ->getLongestSubstring();
    }

    /**
     * Remove all non-word chars
     * @return $this
     */
    private function cleanString()
    {
        $this->cleanedString = mb_ereg_replace('\P{L}', '', $this->originalString);
        return $this;
    }

    /**
     * Split string on chars and wrap with delimiters in order to adjust length
     * @return $this
     */
    private function formatString()
    {
        $adjustedString = implode('#', preg_split('/(?<!^)(?!$)/u', mb_strtolower($this->cleanedString)));
        $this->formattedString = "^#" . $adjustedString . "#$";
        return $this;
    }

    /**
     * Prepare list of palindromic substring lengths
     * @return $this
     */
    private function calculateLengths()
    {
        $this->lengthTracker = array_fill(0, mb_strlen($this->formattedString), 0);

        $center = 0;
        $right = 0;

        for ($i = 1; $i < mb_strlen($this->formattedString) - 1; ++$i) {
            $mirror = 2 * $center - $i;

            if ($right > $i) {
                $this->lengthTracker[$i] = min($right - $i, $this->lengthTracker[$mirror]);
            }

            while(
                mb_substr($this->formattedString, $i + (1 + $this->lengthTracker[$i]), 1) ==
                mb_substr($this->formattedString, $i - (1 + $this->lengthTracker[$i]), 1)
            ) {
                $this->lengthTracker[$i]++;
            }

            if ($i + $this->lengthTracker[$i] > $right) {
                $center = $i;
                $right = $i + $this->lengthTracker[$i];
            }
        }

        return $this;
    }

    /**
     * Extract the longest palindromic substring followed by max length in tracker
     * @return string
     */
    private function getLongestSubstring()
    {
        $maxLength = max($this->lengthTracker);

        // If 2 items with equal length found return first occurrence
        $center = reset(array_keys($this->lengthTracker, $maxLength));

        $substring = mb_substr($this->cleanedString, ($center - 1 - $maxLength) / 2, $maxLength);
        return mb_strtolower($substring);
    }
}
