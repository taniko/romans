<?php
namespace Taniko\Romans;

use Symfony\Polyfill\Mbstring\Mbstring;

class Parser
{
    private static $romans = [
        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
        'C' => 100,  'XC' => 90,  'L' => 50,  'XL' => 40,
        'X' => 10,   'IX' => 9,   'V' => 5,   'IV' => 4, 'I'  => 1
    ];

    /**
     * convert roman numerals to decimal
     * @param  string $str roman numerals
     * @return int         decimal
     */
    public static function toInt(string $str) : int
    {
        $result = 0;
        $str    = self::replaceRoman($str);
        foreach (self::$romans as $key => $value) {
            while (mb_strpos($str, $key) === 0) {
                $result += $value;
                $str = mb_substr($str, strlen($key));
            }
        }
        return $result;
    }

    /**
     * convert decimal to roman numerals
     * @param  int    $num decimal
     * @return string      roman numerals
     */
    public static function toRoman(int $num) : string
    {
        $result = '';
        foreach (self::$romans as $roman => $value) {
            $matches = intval($num / $value);
            $result .= str_repeat($roman, $matches);
            $num     = $num % $value;
        }
        return $result;
    }

    /**
     * convert decimal to small roman numerals
     * @param  int    $num decimal
     * @return string      roman numerals
     */
    public static function toSmallRoman(int $num) : string
    {
        return strtolower(self::toRoman($num));
    }

    /**
     * return splited string
     * @param  string $str string
     * @return array       splited string
     */
    public static function strToArray(string $str) : array
    {
        return preg_split('/(?<!^)(?!$)/u', $str);
    }

    /**
     * replace UTF-8 roman numerals
     * @param  string $str roman numerals
     * @return string      roman numerals
     */
    public static function replaceRoman(string $str) : string
    {
        $str = self::strToArray($str);
        return implode('', self::replaceRomanArray($str));
    }

    /**
     * replace UTF-8 roman numerals
     * @param  array $str roman numerals
     * @return array      roman numerals
     */
    public static function replaceRomanArray(array $str) : array
    {
        foreach ($str as $key => $value) {
            $code = Mbstring::mb_ord($value);
            if ($code >= 8544 && $code <= 8555) {
                $str[$key] = self::toRoman($code - 8543);
            } elseif ($code >= 8560 && $code <= 8571) {
                $str[$key] = self::toSmallRoman($code - 8559);
            } else {
                switch ($code) {
                    case 8556:
                        $str[$key] = self::toRoman(50);
                        break;
                    case 8557:
                        $str[$key] = self::toRoman(100);
                        break;
                    case 8558:
                        $str[$key] = self::toRoman(500);
                        break;
                    case 8559:
                        $str[$key] = self::toRoman(1000);
                        break;
                    case 8572:
                        $str[$key] = self::toSmallRoman(50);
                        break;
                    case 8573:
                        $str[$key] = self::toSmallRoman(100);
                        break;
                    case 8574:
                        $str[$key] = self::toSmallRoman(500);
                        break;
                    case 8575:
                        $str[$key] = self::toSmallRoman(1000);
                        break;
                    default:
                        break;
                }
            }
        }
        return $str;
    }
}
