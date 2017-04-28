<?php
namespace Taniko\Romans;

use Symfony\Polyfill\Mbstring\Mbstring;

class Roman
{
    private static $romans = [
        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
        'C' => 100,  'XC' => 90,  'L' => 50,  'XL' => 40,
        'X' => 10,   'IX' => 9,   'V' => 5,   'IV' => 4, 'I'  => 1
    ];

    /**
     * validate that string is roman numerals
     * @param  string $str variable being evaluated
     * @return bool        return true or false
     */
    public static function isRoman(string $str) : bool
    {
        $str    = strtoupper(Parser::replaceRoman($str));
        $ary    = Parser::strToArray($str);
        $result = true;
        foreach ($ary as $key => $value) {
            $code = Mbstring::mb_ord($value);
            if ($code >= 97 && 122) {
                $value = strtoupper($value);
            }
            if (array_key_exists($value, self::$romans)) {
                continue;
            } else {
                $result = false;
                break;
            }
        }
        if ($result) {
            foreach (self::$romans as $key => $value) {
                while (mb_strpos($str, $key) === 0) {
                    $str = mb_substr($str, strlen($key));
                }
            }
            $result = mb_strlen($str) === 0;
        }
        return $result;
    }
}
