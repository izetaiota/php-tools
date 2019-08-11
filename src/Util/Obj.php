<?php

/**
 * 对象处理类
 */

namespace src\Util;

class Obj
{
    /***************** 对象转数组 ***********************/
    //PHP stdClass Object转array
    public static function object_array($array)
    {
        if (is_object($array))
        {
            $array = (array)$array;
        }
        if (is_array($array))
        {
            foreach ($array as $key => $value)
            {
                $array[ $key ] = object_array($value);
            }
        }

        return $array;
    }

    //xml转对象转数组
    public static function xml2obj2arr($xmlString)
    {
        $array = json_decode(json_encode(simplexml_load_string($xmlString)), TRUE);

        return $array;
    }

    //对象转数组
    public static function object2array(&$object)
    {
        $object = json_decode(json_encode($object), TRUE);

        return $object;
    }

}