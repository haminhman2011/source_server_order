<?php
/**
 * Created by PhpStorm.
 * User: Team
 * Date: 8/17/2016
 * Time: 12:11 PM
 */

namespace common\utils\helpers;

use Yii;
use yii\helpers\BaseInflector;
use yii\i18n\PhpMessageSource;

class Inflector extends BaseInflector
{
    /**
     * Initialize translations
     * @throws \yii\base\InvalidParamException
     */
    public static function initI18N()
    {
        if ( ! empty(Yii::$app->i18n->translations['yii']) && ! empty(Yii::$app->i18n->translations['number'])) {
            return;
        }
        Yii::setAlias('@yii', __DIR__);
        Yii::$app->i18n->translations['yii*'] = [
            'class'            => PhpMessageSource::class,
            'basePath'         => '@yii/messages',
            'forceTranslation' => true
        ];
    }

    /**
     * Check if a variable is empty or not set.
     *
     * @param mixed $var variable to perform the check
     *
     * @return boolean
     */
    public static function isEmpty($var)
    {
        /** @noinspection UnSafeIsSetOverArrayInspection */
        /** @noinspection NestedTernaryOperatorInspection */
        return ! isset($var) ? true : (is_array($var) ? empty($var) : ($var === null || $var === ''));
    }

    /**
     * Check if a value exists in the array. This method is faster in performance than the built in PHP in_array method.
     *
     * @param string $needle the value to search
     * @param array $haystack the array to scan
     *
     * @return boolean
     */
    public static function inArray($needle, $haystack)
    {
        $flippedHaystack = array_flip($haystack);

        return isset($flippedHaystack[$needle]);
    }

    /**
     * Properize a string for possessive punctuation.
     *
     * @param string $string input string
     *
     * Example:
     * ~~~
     * properize("Chris"); //returns Chris'
     * properize("David"); //returns David's
     * ~~~
     *
     * @return string
     */
    public static function properize($string)
    {
        $string = preg_replace('/\s+(.*?)\s+/', '*\1*', $string);

        return $string . '\'' . ($string[strlen($string) - 1] != 's' ? 's' : '');
    }

    /**
     * Format and convert "bytes" to its optimal higher metric unit
     *
     * @param double $bytes number of bytes
     * @param integer $precision the number of decimal places to round off
     *
     * @return string
     */
    public static function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow   = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow   = min($pow, count($units) - 1);

        $bytes /= $pow ** 1024;

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Number to words conversion. Returns the number converted as an anglicized string.
     *
     * @param int $num the source number
     *
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public static function numToWords($num)
    {
        $num = (int)$num; // make sure it's an integer
        if ($num < 0) {
            return Yii::t('number', 'minus') . '' . static::convertTri(-$num, 0);
        }
        if ($num == 0) {
            return Yii::t('number', 'zero');
        }

        return static::convertTri($num, 0);
    }

    /**
     * Recursive function used in number to words conversion. Converts three digits per pass.
     *
     * @param double $num the source number
     * @param int $tri the three digits converted per pass.
     *
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    protected static function convertTri($num, $tri)
    {
        // chunk the number ...xyz
        $x = (int)($num / 1000);
        $y = ($num / 100) % 10;
        $z = $num % 100;

        // init the output string
        $str      = '';
        $ones     = static::generateOnes();
        $tens     = static::generateTens();
        $triplets = static::generateTriplets();

        // do hundreds
        if ($y > 0) {
            $str = $ones[$y] . ' ' . Yii::t('number', 'hundred');
        }

        // do ones and tens
        $str .= $z < 20 ? $ones[$z] : $tens[(int)($z / 10)] . $ones[$z % 10];

        // add triplet modifier only if there is some output to be modified...
        if ($str != '') {
            $str .= $triplets[$tri];
        }

        // recursively process until valid thousands digit found
        return $x > 0 ? static::convertTri($x, $tri + 1) . $str : $str;
    }

    /**
     * Generate list of ones
     *
     * @return array
     * @throws \yii\base\InvalidParamException
     */
    public static function generateOnes()
    {
        static::initI18N();

        return [
            '',
            ' ' . Yii::t('number', 'one'),
            ' ' . Yii::t('number', 'two'),
            ' ' . Yii::t('number', 'three'),
            ' ' . Yii::t('number', 'four'),
            ' ' . Yii::t('number', 'five'),
            ' ' . Yii::t('number', 'six'),
            ' ' . Yii::t('number', 'seven'),
            ' ' . Yii::t('number', 'eight'),
            ' ' . Yii::t('number', 'nine'),
            ' ' . Yii::t('number', 'ten'),
            ' ' . Yii::t('number', 'eleven'),
            ' ' . Yii::t('number', 'twelve'),
            ' ' . Yii::t('number', 'thirteen'),
            ' ' . Yii::t('number', 'fourteen'),
            ' ' . Yii::t('number', 'fifteen'),
            ' ' . Yii::t('number', 'sixteen'),
            ' ' . Yii::t('number', 'seventeen'),
            ' ' . Yii::t('number', 'eighteen'),
            ' ' . Yii::t('number', 'nineteen')
        ];
    }

    /**
     * Generate list of tens
     *
     * @return array
     * @throws \yii\base\InvalidParamException
     */
    public static function generateTens()
    {
        static::initI18N();

        return [
            '',
            '',
            ' ' . Yii::t('number', 'twenty'),
            ' ' . Yii::t('number', 'thirty'),
            ' ' . Yii::t('number', 'forty'),
            ' ' . Yii::t('number', 'fifty'),
            ' ' . Yii::t('number', 'sixty'),
            ' ' . Yii::t('number', 'seventy'),
            ' ' . Yii::t('number', 'eighty'),
            ' ' . Yii::t('number', 'ninety')
        ];
    }

    /**
     * Generate list of triplets
     *
     * @return array
     * @throws \yii\base\InvalidParamException
     */
    public static function generateTriplets()
    {
        static::initI18N();

        return [
            '',
            ' ' . Yii::t('number', 'thousand'),
            ' ' . Yii::t('number', 'million'),
            ' ' . Yii::t('number', 'billion'),
            ' ' . Yii::t('number', 'trillion'),
            ' ' . Yii::t('number', 'quadrillion'),
            ' ' . Yii::t('number', 'quintillion'),
            ' ' . Yii::t('number', 'sextillion'),
            ' ' . Yii::t('number', 'septillion'),
            ' ' . Yii::t('number', 'octillion'),
            ' ' . Yii::t('number', 'nonillion'),
        ];
    }

    /**
     * Generates a boolean list
     *
     * @param string $false the label for the false value
     * @param string $true the label for the true value
     *
     * @return array
     * @throws \yii\base\InvalidParamException
     */
    public static function generateBoolList($false = null, $true = null)
    {
        static::initI18N();

        return [
            false => empty($false) ? Yii::t('yii', 'No') : $false, // == 0
            true  => empty($true) ? Yii::t('yii', 'Yes') : $true,  // == 1
        ];
    }

    /**
     * Parses and returns a variable type
     *
     * @param string $var the variable to be parsed
     *
     * @return string
     */
    public static function getType($var)
    {
        if (is_array($var)) {
            return 'array';
        } elseif (is_object($var)) {
            return 'object';
        } elseif (is_resource($var)) {
            return 'resource';
        } /** @noinspection IsNullFunctionUsageInspection */
        elseif (is_null($var)) {
            return 'NULL';
        } elseif (is_bool($var)) {
            return 'boolean';
        } elseif (is_float($var) || (is_numeric(str_replace(',', '', $var)) && strpos($var, '.') > 0 &&
                                     is_float((float)str_replace(',', '', $var)))
        ) {
            return 'float';
        } /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        elseif (is_int($var) || (is_numeric($var) && is_int((int)$var))) {
            return 'integer';
        } elseif (is_scalar($var) && strtotime($var) !== false) {
            return 'datetime';
        } /** @noinspection NotOptimalIfConditionsInspection */
        elseif (is_scalar($var)) {
            return 'string';
        }

        return 'unknown';
    }

    /**
     * Normalizes a user-submitted number for use in code and/or to be saved into the database.
     *
     * @param $number
     * @param string $groupSymbol
     * @param string $decimalSymbol
     *
     * @return mixed
     */
    public static function normalizeNUmber($number, $groupSymbol = ',', $decimalSymbol = '.')
    {
        if (is_string($number)) {
            // Remove any group symbols and use a period for the decimal symbol
            $number = str_replace([$groupSymbol, $decimalSymbol], ['', '.'], $number);
        }

        return $number;
    }
}