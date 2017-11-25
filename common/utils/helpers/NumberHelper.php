<?php
/**
 * Created by PhpStorm.
 * User: Team
 * Date: 9/11/2017
 * Time: 1:50 PM
 */

namespace common\utils\helpers;

use yii\base\Exception;

class NumberHelper
{
    /**
     * Returns a random integer in the range $min..$max inclusive.
     *
     * Substitutes for the random_int() in PHP 7.
     *
     * @param int $min Minimum value of the returned integer. Default = 0.
     * @param int $max Maximum value of the returned integer Default = 9999.
     *
     * @return int The generated random integer.
     * @throws Exception
     * @throws \Exception
     */
    public static function generateRandomInt($min = 0, $max = 9999)
    {
        if (function_exists('random_int')) {
            return random_int($min, $max);
        }
        if ( ! is_int($min)) {
            throw new InvalidParamException('First parameter ($min) must be an integer');
        }
        if ( ! is_int($max)) {
            throw new InvalidParamException('Second parameter ($max) must be an integer');
        }
        if ($min > $max) {
            throw new InvalidParamException('First parameter ($min) must be no greater than second parameter ($max)');
        }
        if ($min === $max) {
            return $min;
        }
        // $range is a PHP float if the expression exceeds PHP_INT_MAX.
        $range = $max - $min + 1;
        if (is_float($range)) {
            $mask = null;
        } else {
            // Make a bit mask of (the next highest power of 2 >= $range) minus one.
            $mask  = 1;
            $shift = $range;
            while ($shift > 1) {
                $shift >>= 1;
                $mask  = ($mask << 1) | 1;
            }
        }
        $tries = 0;
        do {
            $bytes = Yii::$app->security->generateRandomKey(PHP_INT_SIZE);
            // Convert byte string to a signed int by shifting each byte in.
            $value = 0;
            /** @noinspection ForeachInvariantsInspection */
            for ($pos = 0; $pos < PHP_INT_SIZE; $pos++) {
                $value = ($value << 8) | ord($bytes[$pos]);
            }
            if ($mask === null) {
                // Use all bits in $bytes and check $value against $min and $max instead of $range.
                if ($value >= $min && $value <= $max) {
                    return $value;
                }
            } else {
                // Use only enough bits from $bytes to cover the $range.
                $value &= $mask;
                if ($value < $range) {
                    return $value + $min;
                }
            }
            $tries++;
        } while ($tries < self::RANDOM_INT_LOOP_LIMIT);
        // Worst case: this is as likely as self::RANDOM_INT_LOOP_LIMIT heads in as many coin tosses.
        throw new Exception('Unable to generate random int after ' . self::RANDOM_INT_LOOP_LIMIT . ' tries');
    }

    /**
     * Prepends leading zeros to number
     *
     * @param string $value
     * @param int $length
     *
     * @return string
     */
    public static function leadingZeros($value, $length)
    {
        return str_pad($value, $length, '0', STR_PAD_LEFT);
    }

    /**
     * Calculates percentage from two numbers
     *
     * @param float $original
     * @param float $new
     * @param bool $factor If enabled, `75%` will result in `0.75`.
     *
     * @return float
     */
    public static function calculatePercentage($original, $new, $factor = true)
    {
        $result = ($original - $new) / $original;
        if ( ! $factor) {
            $result *= 100;
        }

        return $result;
    }

    /**
     * Returns percentage from number
     *
     * @param float $number
     * @param float $percents
     *
     * @return float
     */
    public static function getPercentage($number, $percents)
    {
        return $number / 100 * $percents;
    }

    /**
     * Increase number by percents
     *
     * @param float $number
     * @param float $percents
     *
     * @return float
     */
    public static function increaseByPercentage($number, $percents)
    {
        return $number + static::getPercentage($number, $percents);
    }

    /**
     * Increase number by percents
     *
     * @param float $number
     * @param float $percents
     *
     * @return float
     */
    public static function decreaseByPercentage($number, $percents)
    {
        return $number - static::getPercentage($number, $percents);
    }
}