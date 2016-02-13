<?php

namespace Komakino\RomanNumerals;

class RomanNumerals
{
    static $zero = 'nulla';

    static $map = [
        'M' => 1000,
        'D' => 500,
        'C' => 100,
        'L' => 50,
        'X' => 10,
        'V' => 5,
        'I' => 1,
    ];

    public static function to($number)
    {
        $number = intval($number);
        if($number === 0) return static::$zero;
        elseif($number < 0){
            throw new \OutOfBoundsException('Cannot convert negative numbers');
        }
        elseif($number >= 4000){
            throw new \OutOfBoundsException('Cannot convert numbers over 3999');
        }


        $roman  = "";
        $map    = array_flip(static::$map);

        foreach($map as $int => $char){
            $subtractor = floor($int/(strval($int)[0]%5 ? 10 : 5));
            while($number >= $int){
                $roman  .= $char;
                $number -= $int;
            }
            while($number >= ($int - $subtractor)){
                $roman  .= $map[$subtractor] . $char;
                $number -= ($int - $subtractor);
            }
        }

        return $roman;
    }

    private static function validateRomanString($roman)
    {
        $zero = static::$zero;
        $chars = implode('',array_keys(static::$map));
        return !!preg_match("/^({$zero}|[{$chars}]*)$/",$roman);
    }

    public static function from($roman)
    {
        if(!static::validateRomanString($roman)){
            throw new \InvalidArgumentException('Input contains illegal characters');
        }
        $number = 0;

        if($roman == static::$zero) return $number;

        $array  = str_split($roman);
        $max    = count($array) -1;

        foreach($array as $i => $char){
            if($i < $max && static::$map[$array[$i+1]] > static::$map[$char]){
                $number -= static::$map[$char];
            } else {
                $number += static::$map[$char];
            }
        }

        return $number;
    }
}