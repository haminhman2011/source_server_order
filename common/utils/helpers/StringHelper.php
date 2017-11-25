<?php

namespace common\utils\helpers;

use yii\helpers\BaseStringHelper;

class StringHelper extends BaseStringHelper
{
    /**
     * Pads string on the left and right sides if it's shorter than length. Padding characters are truncated if they can't be evenly divided by length
     *
     * @param $string
     * @param int $length
     * @param string $padStr
     *
     * @return string
     */
    public static function pad($string, $length = 0, $padStr = ' ')
    {
        return str_pad($string, $length, $padStr, STR_PAD_BOTH);
    }

    /**
     * Pads string on the right side if it's shorter than length. Padding characters are truncated if they exceed length
     *
     * @param $string
     * @param int $length
     * @param string $padStr
     *
     * @return string
     */
    public static function padEnd($string, $length = 0, $padStr = ' ')
    {
        return str_pad($string, $length, $padStr, STR_PAD_RIGHT);
    }

    /**
     * Pads string on the left side if it's shorter than length. Padding characters are truncated if they exceed length
     *
     * @param $string
     * @param int $length
     * @param string $padStr
     *
     * @return string
     */
    public static function padStart($string, $length = 0, $padStr = ' ')
    {
        return str_pad($string, $length, $padStr, STR_PAD_LEFT);
    }

    /**
     * Repeats the given string n times
     *
     * @param $string
     * @param $multiplier
     *
     * @return string
     */
    public static function repeat($string, $multiplier)
    {
        return str_repeat($string, $multiplier);
    }

    /**
     * Replace only the first occurance found inside the string.
     *
     * The replace first method is *case sensitive*.
     *
     * ```php
     * StringHelper::replaceFirst('abc', '123', 'abc abc abc'); // returns "123 abc abc"
     * ```
     *
     * @param string $search Search string to look for.
     * @param string $replace Replacement value for the first found occurrence.
     * @param string $subject The string you want to look up to replace the first element.
     *
     * @return mixed Replaced string
     */
    public static function replaceFirst($search, $replace, $subject)
    {
        return preg_replace('/' . preg_quote($search, '/') . '/', $replace, $subject, 1);
    }

    /**
     * Check whether a char or word exists in a string or not.
     *
     * This method is case sensitive. The need can be an array with multiple chars or words who
     * are going to look up in the haystack string.
     *
     * If an array of needle words is provided the $strict parameter defines whether all need keys must be found
     * in the string to get the `true` response or if just one of the keys are found the response is already `true`.
     *
     * @param string|array $needle The char or word to find in the $haystack. Can be an array to multi find words or char in the string.
     * @param string $haystack The haystack where the $needle string should be looked  up.
     * @param boolean $strict If an array of needles is provided the $strict parameter defines whether all keys must be found ($strict = true) or just one result must be found ($strict = false).
     *
     * @return boolean If an array of values is provided the response
     */
    public static function contains($needle, $haystack, $strict = false)
    {
        $needles = (array)$needle;

        $state = false;

        foreach ($needles as $item) {
            $state = (strpos($haystack, $item) !== false);

            if ($strict && ! $state) {
                return false;
            }

            if ( ! $strict && $state) {
                return true;
            }
        }

        return $state;
    }
}