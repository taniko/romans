<?php
namespace Taniko\Romans;

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
     * return splited string
     * @param  string $str string
     * @return array       splited string
     */
    public static function strToArray(string $str) : array
    {
        return preg_split('/(?<!^)(?!$)/u', $str);
    }

    /**
     * return UTF-8 value of character
     * @param  string $str a character
     * @param  string $enc encoding
     * @return int         UTF-8 value
     */
    private static function ord(string $str, string $enc = null) : int
    {
        return \Symfony\Polyfill\Mbstring\Mbstring::mb_ord($str, $enc);
    }

    /**
     * replace UTF-8 roman numerals
     * @param  string $str roman numerals
     * @return string      roman numerals
     */
    public static function replaceRoman(string $str) : string
    {
        $str = self::strToArray($str);
        foreach ($str as $key => $value) {
            $code = self::ord($value);
            if ($code >= 8544 && $code <= 8555) {
                $str[$key] = self::toRoman($code - 8543);
            }
        }
        return implode('', $str);
    }

    /**
     * replace UTF-8 roman numerals
     * @param  array $str roman numerals
     * @return array      roman numerals
     */
    public static function replaceRomanArray(array $str) : array
    {
        foreach ($str as $key => $value) {
            $code = self::ord($value);
            if ($code >= 8544 && $code <= 8555) {
                $str[$key] = self::toRoman($code - 8543);
            }
        }
        return $str;
    }
}
